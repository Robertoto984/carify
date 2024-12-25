<?php

namespace App\Services\MovementCommand;

use Carbon\Carbon;
use App\Models\MovementCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateMovementCommandService
{

    public function update($request, $id)
    {
        $row = MovementCommand::where('id', $id)->first();

        $row->update([
            'organized_by' => auth()->user()->name,
            'number' => $request['number'][0], // Access the first element
            'date' => $request['date'][0],
            'responsible' => $request['responsible'][0],
            'truck_id' => $request['truck_id'][0],
            'driver_id' => $request['driver_id'][0],
            'destination' => $request['destination'][0],
            'task_start_time' => $request['task_start_time'][0],
            'task_end_time' => $request['task_end_time'][0],
            'initial_odometer_number' => $request['initial_odometer_number'][0],
            'final_odometer_number' => $request['final_odometer_number'][0],
            'distance' => $request['distance'][0],
            'task' => $request['task'][0],
            'notes' => $request['notes'][0],
        ]);
        foreach ($request['escort_id'] as $escort) {
            DB::table('movement_escorts')
                ->where('mov_command_id', $row->id)
                ->updateOrInsert([
                    'mov_command_id' => $row->id,
                    'escort_id' => $escort
                ]);
        }
    }
}
