<?php
namespace App\Services\MovementCommand;

use App\Models\MovementCommand;
use Illuminate\Support\Facades\DB;

class CompleteMovementCommands
{

    public function update($request, $id)
    {
        $row = MovementCommand::where('id', $id)->first();

        $row->update([
            'task_end_time' => $request['task_end_time'][0],
            'final_odometer_number' => $request['final_odometer_number'][0],
            'distance' => $request['distance'][0],
            'notes' => $request['notes'][0],
        ]);
    }
}