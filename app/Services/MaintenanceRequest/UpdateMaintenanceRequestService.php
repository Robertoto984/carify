<?php

namespace App\Services\MaintenanceRequest;

use Carbon\Carbon;
use App\Models\MaintenanceRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateMaintenanceRequestService
{

    public function update($request, $id)
    {
        $maintenanceRequest = MaintenanceRequest::findOrFail($id);

        $currentProducts = DB::table('request_product')
            ->where('request_id', $maintenanceRequest->id)
            ->pluck('product_id')
            ->toArray();

        DB::beginTransaction();
        try {
            if (isset($request['product_id'], $request['quantity'], $request['unit_price'], $request['procedure_id'])) {
                $newProducts = $request['product_id'];

                $productsToRemove = array_diff($currentProducts, $newProducts);
                $productsToAdd = array_diff($newProducts, $currentProducts);

                if (!empty($productsToRemove)) {
                    DB::table('request_product')
                        ->where('request_id', $maintenanceRequest->id)
                        ->whereIn('product_id', $productsToRemove)
                        ->delete();
                }

                $currentTimestamp = Carbon::now();
                foreach ($newProducts as $key => $productId) {
                    $existingPivot = DB::table('request_product')
                        ->where('request_id', $maintenanceRequest->id)
                        ->where('product_id', $productId)
                        ->first();

                    $quantity = $request['quantity'][$key];
                    $unitPrice = $request['unit_price'][$key];
                    $totalPrice = $quantity * $unitPrice;
                    $procedureId = $request['procedure_id'][$key];

                    if ($existingPivot) {
                        DB::table('request_product')
                            ->where('request_id', $maintenanceRequest->id)
                            ->where('product_id', $productId)
                            ->update([
                                'procedure_id' => $procedureId,
                                'quantity' => $quantity,
                                'unit_price' => $unitPrice,
                                'total_price' => $totalPrice,
                                'updated_at' => $currentTimestamp,
                            ]);
                    } else {
                        DB::table('request_product')->insert([
                            'request_id' => $maintenanceRequest->id,
                            'procedure_id' => $procedureId,
                            'product_id' => $productId,
                            'quantity' => $quantity,
                            'unit_price' => $unitPrice,
                            'total_price' => $totalPrice,
                            'created_at' => $currentTimestamp,
                            'updated_at' => $currentTimestamp,
                        ]);
                    }
                }
            }

            $total = $maintenanceRequest->calculateTotal();

            $maintenanceRequest->update([
                'number' => $request['number'],
                'date' => $request['date'],
                'type' => $request['type'],
                'created_by' => $request['created_by'],
                'truck_id' => $request['truck_id'],
                'driver_id' => $request['driver_id'],
                'odometer_number' => $request['odometer_number'],
                'notes' => $request['notes'],
                'total' => $total,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error during maintenance order update: ' . $e->getMessage());
            throw $e;
        }
    }
}
