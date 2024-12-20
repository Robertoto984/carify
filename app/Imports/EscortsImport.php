<?php

namespace App\Imports;

use App\Models\Escort;
use Maatwebsite\Excel\Concerns\ToModel;

class EscortsImport implements ToModel
{
    private $counter =0;

    public function model(array $row)
    {
        $this->counter++;
        
        if ($this->counter > 1) {
            if (empty($row[0])) {
                return null;
            }

            $escort = new Escort();
            $escort->first_name = $row[0];
            $escort->last_name = $row[1];
            $escort->birth_date = $row[2];
            $escort->license_expiration_date = $row[3];
            $escort->license_type = $row[4];
            $escort->phone = $row[5];
            $escort->address = $row[6];
            $escort->save();
        }
    }
}
