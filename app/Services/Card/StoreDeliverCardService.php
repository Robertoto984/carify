<?php

namespace App\Services\Card;

use App\Models\TruckDeliverCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StoreDeliverCardService
{
   public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $year = Carbon::createFromFormat('Y', $data['year'])->format('Y');
            $model = Carbon::createFromFormat('Y', $data['model'])->format('Y');
            $register = Carbon::createFromFormat('Y', $data['register'])->format('Y');
            $demarcation_date = Carbon::createFromFormat('Y-m-d', $data['demarcation_date'])->format('Y-m-d');
            $receipt_date = Carbon::createFromFormat('Y-m-d', $data['receipt_date'])->format('Y-m-d');
            $deliver_date = Carbon::createFromFormat('Y-m-d', $data['deliver_date'])->format('Y-m-d');
            return TruckDeliverCard::create([
                'type' => $data['type'],
                'manufacturer' => $data['manufacturer'],
                'plate_number' => $data['plate_number'],
                'chassis_number' => $data['chassis_number'],
                'engine_number' => $data['engine_number'],
                'traffic_license_number' => $data['traffic_license_number'],
                'legal_status' => $data['legal_status'],
                'fuel_type' => $data['fuel_type'],
                'year' => $year,
                'model' => $model,
                'passengers_number' => $data['passengers_number'],
                'gross_weight' => $data['gross_weight'],
                'empty_weight' => $data['empty_weight'],
                'load' => $data['load'],
                'kilometer_number' => $data['kilometer_number'],
                'technical_status' => $data['technical_status'],
                'color' => $data['color'],
                'register' => $register,
                'demarcation_date' => $demarcation_date,
                'receipt_date' => $receipt_date,
                'deliver_date' => $deliver_date,
                'driver_id' => $data['driver_id'],
                'truck_id' => $data['truck_id'],
            ]);
        });
    }
}
