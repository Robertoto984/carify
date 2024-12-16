<?php

namespace App\Services\Truck;

use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AddTruckService
{
    public function store(array $trucksData)
    {
        foreach ($trucksData['type'] as $key => $type) {
            $year = Carbon::createFromFormat('d/m/Y', $trucksData['year'][$key])->year;
            $model = Carbon::createFromFormat('d/m/Y', $trucksData['model'][$key])->year;
            $register = Carbon::createFromFormat('d/m/Y', $trucksData['register'][$key])->year;
            $demarcation_date = Carbon::createFromFormat('d/m/Y', $trucksData['demarcation_date'][$key])->format('Y-m-d');
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

    public function updateTruck($request,$id)
    {
        // dd($request);
        $truck = Truck::where('id',$id)->first();
        $year = $request['year'];
        $model = $request['model'];
        $register =$request['register'];
        $demarcation_date = Carbon::createFromFormat('d/m/Y', $request['demarcation_date'])->format('Y-m-d');
       
        $truck->update([
            'type' => $request['type'],
            'manufacturer' => $request['manufacturer'],
            'plate_number' => $request['plate_number'],
            'chassis_number' => $request['chassis_number'],
            'engine_number' => $request['engine_number'],
            'traffic_license_number' => $request['traffic_license_number'],
            'legal_status' => $request['legal_status'],
            'fuel_type' => $request['fuel_type'],
            'year' => $year,
            'model' => $model,
            'passengers_number' => $request['passengers_number'],
            'gross_weight' => $request['gross_weight'],
            'empty_weight' => $request['empty_weight'],
            'load' => $request['load'],
            'kilometer_number' => $request['kilometer_number'],
            'technical_status' => $request['technical_status'],
            'color' => $request['color'],
            'register' => $register,
            'demarcation_date' => $demarcation_date,
            'parts_description' => $request['parts_description'] ?? null,
        ]);

    }
}
