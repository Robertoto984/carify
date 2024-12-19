<?php

namespace App\Imports;

use App\Models\Driver;
use Maatwebsite\Excel\Concerns\ToModel;

class DriversImport implements ToModel
{
    private $counter =0;

    public function model(array $row)
    {
        $this->counter ++;
        
        if ($this->counter > 1) {
            if (empty($row[0])) {
                return null;
            }

            $driver = new Driver();
            $driver->first_name = $row[0];
            $driver->last_name = $row[1];
            $driver->birth_date = $row[2];
            $driver->license_expiration_date = $row[3];
            $driver->license_type = $row[4];
            $driver->phone = $row[5];
            $driver->address = $row[6];
            $driver->save();
        }
    }

}
