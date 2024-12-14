<?php

namespace App\Services\Truck;

use App\Models\Truck;

class AddTruckService
{
    public function store(array $vehiclesData)
    {
        foreach ($vehiclesData['type'] as $index => $type) {
            Truck::create([
                'type' => $type,
                'manufacturer' => $vehiclesData['manufacturer'][$index],
                'plate_number' => $vehiclesData['plate_number'][$index],
                'chassis_number' => $vehiclesData['chassis_number'][$index] ?? null,
                'engine_number' => $vehiclesData['engine_number'][$index] ?? null,
                'traffic_license_number' => $vehiclesData['traffic_license_number'][$index] ?? null,
                'legal_status' => $vehiclesData['legal_status'][$index] ?? null,
                'fuel_type' => $vehiclesData['fuel_type'][$index] ?? null,
                'year' => $vehiclesData['year'][$index] ?? null,
                'model' => $vehiclesData['model'][$index] ?? null,
                'passengers_number' => $vehiclesData['passengers_number'][$index] ?? null,
                'gross_weight' => $vehiclesData['gross_weight'][$index] ?? null,
                'empty_weight' => $vehiclesData['empty_weight'][$index] ?? null,
                'load' => $vehiclesData['load'][$index] ?? null,
                'kilometer_number' => $vehiclesData['kilometer_number'][$index] ?? null,
                'technical_status' => $vehiclesData['technical_status'][$index] ?? null,
                'color' => $vehiclesData['color'][$index] ?? null,
                'driver_id' => $vehiclesData['driver_id'][$index] ?? null,
                'register' => $vehiclesData['register'][$index] ?? null,
                'demarcation_date' => $vehiclesData['demarcation_date'][$index] ?? null,
            ]);
        }
    }
}

