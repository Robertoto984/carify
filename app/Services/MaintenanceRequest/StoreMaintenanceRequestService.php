<?php

namespace App\Services\MaintenanceRequest;

use App\Models\MaintenanceRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StoreMaintenanceRequestService
{
    public function store(array $orders)
    {
        DB::beginTransaction();
        try {
            foreach ($orders['number'] as $key => $value) {
                $row = MaintenanceRequest::create([
                    'number' => $value,
                    'date' => $orders['date'][$key],
                    'type' => $orders['type'][$key],
                    'truck_id' => $orders['truck_id'][$key],
                    'driver_id' => $orders['driver_id'][$key],
                    'odometer_number' => $orders['odometer_number'][$key],
                    'created_by' => $orders['created_by'][$key],
                    'total' => $orders['total'][$key],
                    'notes' => $orders['notes'][$key],
                ]);
            }

            if (isset($orders['product_id']) && is_array($orders['product_id'])) {
                foreach ($orders['product_id'] as $prod) {
                    DB::table('request_product')->insert([
                        'request_id' => $row->id,  // Use the inserted ID
                        'procedure_id' => $orders['procedure_id'][$key],
                        'product_id' => $prod,
                        'quantity' => $orders['quantity'][$key],
                        'unit_price' => $orders['unit_price'][$key],
                        'total_price' => $orders['total_price'][$key],
                        'created_at' => Carbon::now(),
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
