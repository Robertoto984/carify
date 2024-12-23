<?php

namespace App\Services\MovementCommand;

use App\Models\MovementCommand;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateMovementCommandService
{

    public function update($request, $id)
    {
        $row = MovementCommand::where('id', $id)->first();
       
        $row->update([
            'organized_by' => auth()->user()->name,
            'number' => $request['number'],
            'date' => $request['date'],
            'responsible' => $request['responsible'],
            'truck_id' => $request['truck_id'],
            'driver_id' => $request['driver_id'],
            'destination' => $request['destination'],
            'task_start_time' => $request['task_start_time'],
            'task_end_time' => $request['task_end_time'],
            'initial_odometer_number' => $request['initial_odometer_number'],
            'final_odometer_number' => $request['final_odometer_number'],
            'distance' => $request['distance'],
            'task' => $request['task'],
            'notes' => $request['notes'],
        ]);


        foreach ($request['escort_id'] as $escort) {
            DB::table('movement_escorts')->where('mov_command_id', $row->id)->update(['escort_id' => $escort]);
        }
    }

}
