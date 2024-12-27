<?php

namespace App\Imports;

use App\Models\MaintenanceTypes;
use Maatwebsite\Excel\Concerns\ToModel;

class MaintenanceTypesImport implements ToModel
{
    private $counter = 0;

    public function model(array $row)
    {
        $this->counter++;

        if ($this->counter > 1) {
            if (empty($row[0])) {
                return null;
            }

            $user = new MaintenanceTypes();
            $user->name = $row[0];
            $user->save();
        }
    }
}
