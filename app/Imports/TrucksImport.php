<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Enums\Color;
use App\Models\Truck;
use App\Enums\FuelTypes;
use Maatwebsite\Excel\Concerns\ToModel;

class TrucksImport implements ToModel
{
    private $counter =0;

    public function model(array $row)
    {
        $this->counter ++;
        
        if ($this->counter > 1) {
            if (empty($row[0])) {
                return null;
            }

            $truck = new Truck();
            $truck->type = $row[0];
            $truck->manufacturer = $row[1];
            $truck->year = Carbon::createFromFormat('Y', $row[2])->year;
            $truck->register = Carbon::createFromFormat('Y', $row[3])->year;
            $truck->model = Carbon::createFromFormat('Y', $row[4])->year;
            $truck->plate_number = $row[5];
            $truck->chassis_number = $row[6];
            $truck->engine_number = $row[7];
            $truck->traffic_license_number = $row[8];
            $truck->demarcation_date = Carbon::createFromFormat('Y-m-d', $row[9])->toDateString();
            $colorValue = $row[10];
            if (in_array($colorValue, Color::values())) {
                $truck->color = $colorValue;
            }
            $fuelValue = $row[11];
            if (in_array($fuelValue, FuelTypes::values())) {
                $truck->fuel_type = $fuelValue;
            }
            $truck->passengers_number = $row[12];
            $truck->gross_weight = $row[13];
            $truck->empty_weight = $row[14];
            $truck->load = $row[15];
            $truck->kilometer_number = $row[16];
            $truck->technical_status = $row[17];
            $truck->legal_status = $row[18];
            $truck->parts_description = $row[19];
            $truck->save();
        }
    }
}
