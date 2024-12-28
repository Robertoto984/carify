<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;

class SupplierImport implements ToModel
{
    private $counter =0;

    public function model(array $row)
    {
        $this->counter++;
        
        if ($this->counter > 1) {
            if (empty($row[0])) {
                return null;
            }

            $data = new Supplier();
            $data->name = $row[0];
            $data->trade_name = $row[1];
            $data->address = $row[2];
            $data->email = $row[3];
            $data->phone_1 = $row[4];
            $data->phone_2 = $row[5];
            $data->notes = $row[6];
            $data->save();
        }
    }
}
