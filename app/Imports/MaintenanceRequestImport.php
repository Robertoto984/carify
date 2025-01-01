<?php

namespace App\Imports;

use App\Models\MaintenanceRequest;
use Maatwebsite\Excel\Concerns\ToModel;

class MaintenanceRequestImport implements ToModel
{
    private $counter =0;

    public function model(array $row)
    {
        $this->counter++;
        
        if ($this->counter > 1) {
            if (empty($row[0])) {
                return null;
            }
         
            $data = new MaintenanceRequest();
            $data->number = $row[0];
            $data->type = $row[1];
            $data->date = $row[2];
            $data->total = $row[3];
            $data->notes = $row[4];
            $data->created_by = $row[5];
            $data->odometer_number = $row[6];
            $data->truck_id = $row[7];
            $data->driver_id = $row[8];

            $data->save();
        }
    }
}
