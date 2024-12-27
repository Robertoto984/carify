<?php

namespace App\Services\MovementCommand;

use App\Models\Truck;
use App\Models\MovementCommand;

class CompleteMovementCommandsService
{

    public function update($request, $id)
    {
        $row = MovementCommand::where('id', $id)->first();
        $truckId = $row->truck_id;

        $row->update([
            'status'=>0,
            'task_end_time' => $request['task_end_time'][0],
            'final_odometer_number' => $request['final_odometer_number'][0],
            'distance' => $request['distance'][0],
            'notes' => $request['notes'][0],
        ]);

        Truck::whereId($truckId)->update(['kilometer_number' => $request['final_odometer_number'][0]]);
    }
}
