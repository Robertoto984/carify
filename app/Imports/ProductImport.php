<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    private $counter =0;

    public function model(array $row)
    {
        $this->counter++;
        
        if ($this->counter > 1) {
            if (empty($row[0])) {
                return null;
            }

            $data = new Product();
            $data->code = $row[0];
            $data->name = $row[1];
            $data->qty = $row[2];
            $data->origin_country = $row[3];
            $data->production_date = $row[4];
            $data->expireation_date = $row[5];
            $data->supplier_id = $row[6];
            $data->notes = $row[7];
            $data->save();

        }
    }
}