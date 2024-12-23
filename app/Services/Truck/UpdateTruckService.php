<?php

namespace App\Services\Truck;

use App\Models\Truck;
use Carbon\Carbon;

class UpdateTruckService
{
   
    public function updateTruck($request,$id)
    {
        $truck = Truck::where('id',$id)->first();
        $year = $request['year'];
        $model = $request['model'];
        $register = $request['register'];
        $demarcation_date = Carbon::parse( $request['demarcation_date'])->format('Y-m-d');
       
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
