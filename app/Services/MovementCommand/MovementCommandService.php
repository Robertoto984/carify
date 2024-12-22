<?php

namespace App\Services\MovementCommand;

use App\Models\MovementCommand;
use Illuminate\Support\Facades\DB;

class MovementCommandService
{

    public function store(array $data)
    {
        foreach ($data['number'] as $index => $value) {
            $number = (new MovementCommand())->generateCustomNumber();
            $row = MovementCommand::create([
                'organized_by' => auth()->user()->name,
                'number' => $number,
                'date' => $data['date'][$index],
                'responsible' => $data['responsible'][$index],
                'truck_id' => $data['truck_id'][$index],
                'driver_id' => $data['driver_id'][$index],
                'destination' => $data['destination'][$index],
                'task_start_time' => $data['task_start_time'][$index],
                'task_end_time' => $data['task_end_time'][$index],
                'initial_odometer_number' => $data['initial_odometer_number'][$index],
                'final_odometer_number' => $data['final_odometer_number'][$index],
                'distance' => $data['distance'][$index],
                'task' => $data['task'][$index],
                'notes' => $data['notes'][$index],
            ]);
        }
        foreach ($data['escort_id'] as $escort) {
            DB::table('movement_escorts')->insert(['escort_id' => $escort, 'mov_command_id' => $row->id]);
        }
    }


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
            // 'escort_id'=>$data['escort_id'][$index],
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
