<?php

namespace App\Services\MaintenanceOrder;

use App\Models\MaintenanceOrder;
use Illuminate\Support\Facades\DB;

class StoreMaintenanceOrderService
{

    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            $orderData = [];
            $typeData = [];
            $productData = [];
            foreach ($data['number'] as $index => $value) {
                $orderData[] = [
                    'number' => $data['number'],
                    'date' => $data['date'][$index],
                    'type' => $data['type'][$index],
                    'created_by' => $data['created_by'][$index],
                    'truck_id' => $data['truck_id'][$index],
                    'driver_id' => $data['driver_id'][$index],
                    'notes' => $data['notes'][$index],
                    'odometer_number' => $data['odometer_number'][$index],
                    'total' => $data['total'][$index],
                ];
            }

            foreach ($data['maintenance_order_id'] as $index => $value) {
                $typeData[] = [
                    'maintenance_order_id' => $data['maintenance_order_id'],
                    'maintenance_type_id' => $data['maintenance_type_id'][$index],
                ];
            }

            foreach ($data['maintenance_order_id'] as $index => $value) {
                $productData[] = [
                    'maintenance_order_id' => $data['maintenance_order_id'],
                    'product_id' => $data['product_id'][$index],
                    'quantity' => $data['quantity'][$index],
                    'unit_price' => $data['unit_price'][$index],
                    'total_price' => $data['total_price'][$index],
                ];
            }

            MaintenanceOrder::insert($orderData);

            DB::table('product_maintenance_order')
                ->insert($productData);

            DB::table('maintenance_order_maintenance_type')
                ->insert($typeData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
