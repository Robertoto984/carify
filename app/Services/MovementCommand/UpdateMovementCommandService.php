<?php

namespace App\Services\MovementCommand;

use App\Models\MovementCommand;
use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateMovementCommandService
{

    public function update($request, $id)
    {
        $row = MovementCommand::findOrFail($id);

        $row->update([
            'organized_by' => auth()->user()->name,
            'number' => $request['number'][0],
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

        if (!is_null($request['final_odometer_number'][0])) {
            Truck::whereId($request['truck_id'][0])->update([
                'kilometer_number' => $request['final_odometer_number'][0],
            ]);
        }

        $currentEscorts = DB::table('movement_escorts')
            ->where('mov_command_id', $row->id)
            ->pluck('escort_id')
            ->toArray();

        if (isset($request['escort_id'][0])) {
            $newEscorts = $request['escort_id'];
            $escortsToRemove = array_diff($currentEscorts, $newEscorts);
            $escortsToAdd = array_diff($newEscorts, $currentEscorts);

            if (!empty($escortsToRemove)) {
                DB::table('movement_escorts')
                    ->where('mov_command_id', $row->id)
                    ->whereIn('escort_id', $escortsToRemove)
                    ->delete();
            }

            if (!empty($escortsToAdd)) {
                $dataToInsert = [];
                $currentTimestamp = Carbon::now();
                foreach ($escortsToAdd as $escort) {
                    $dataToInsert[] = [
                        'mov_command_id' => $row->id,
                        'escort_id' => $escort,
                        'created_at' => $currentTimestamp,
                        'updated_at' => $currentTimestamp,
                    ];
                }

                DB::table('movement_escorts')->insert($dataToInsert);
            }

            if (!empty($escortsToRemove)) {
                DB::table('movement_escorts')
                    ->where('mov_command_id', $row->id)
                    ->whereIn('escort_id', $escortsToRemove)
                    ->update([
                        'updated_at' => Carbon::now(),
                    ]);
            }
        }
    }
}
