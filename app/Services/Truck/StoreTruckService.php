<?php

namespace App\Services\Truck;

use App\Models\Truck;
use Carbon\Carbon;

class StoreTruckService
{
    public function store(array $trucksData)
    {
        
        foreach ($trucksData['type'] as $key => $type) {
            $year = Carbon::createFromFormat('Y-m-d', $trucksData['year'][$key])->format('Y');
            $model = Carbon::createFromFormat('Y-m-d', $trucksData['model'][$key])->format('Y');
            $register = Carbon::createFromFormat('Y-m-d', $trucksData['register'][$key])->format('Y');
            $demarcation_date = Carbon::createFromFormat('Y-m-d', $trucksData['demarcation_date'][$key])->format('Y-m-d');
            Truck::create([
                'type' => $type,
                'manufacturer' => $trucksData['manufacturer'][$key],
                'plate_number' => $trucksData['plate_number'][$key],
                'chassis_number' => $trucksData['chassis_number'][$key],
                'engine_number' => $trucksData['engine_number'][$key],
                'traffic_license_number' => $trucksData['traffic_license_number'][$key],
                'legal_status' => $trucksData['legal_status'][$key],
                'fuel_type' => $trucksData['fuel_type'][$key],
                'year' => $year,
                'model' => $model,
                'passengers_number' => $trucksData['passengers_number'][$key],
                'gross_weight' => $trucksData['gross_weight'][$key],
                'empty_weight' => $trucksData['empty_weight'][$key],
                'load' => $trucksData['load'][$key],
                'kilometer_number' => $trucksData['kilometer_number'][$key],
                'technical_status' => $trucksData['technical_status'][$key],
                'color' => $trucksData['color'][$key],
                'register' => $register,
                'demarcation_date' => $demarcation_date,
                'parts_description' => $trucksData['parts_description'] ?? null,
            ]);
        }
    }

    
}
