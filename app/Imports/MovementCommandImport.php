<?php

namespace App\Imports;

use App\Models\MovementCommand;
use Maatwebsite\Excel\Concerns\ToModel;

class MovementCommandImport implements ToModel
{
    private $counter =0;

    public function model(array $row)
    {
        $this->counter++;
        
        if ($this->counter > 1) {
            if (empty($row[0])) {
                return null;
            }

            $command = new MovementCommand();
            
            $command->number = $row[0];
            $command->organized_by  = $row[1];
            $command->date  = $row[2];
            $command->responsible  = $row[3];
            $command->truck->plate_number  = $row[4];
            $command->driver->first_name.''. $command->driver->last_name  = $row[5];
            foreach($command->escort as $escort)
            {
                $escort->first_name.''.$escort->last_name  = $row[6];
            }
           
            $command->destination  = $row[7];
            $command->task  = $row[8];
                                       
            $command->task_start_time  = $row[9];
            $command->task_end_time  = $row[10];
            $command->initial_odometer_number  = $row[11];
            $command->final_odometer_number  = $row[12];
            $command->distance  = $row[13];
            $command->notes  = $row[15];
            $command->save();
        }
    }
}

