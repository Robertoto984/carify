<?php

namespace App\Services\MovementCommand;

use App\Models\MovementCommand;
use Illuminate\Support\Facades\DB;

class StoreMovementCommandService
{

    public function store(array $data)
    {
        // Start a transaction to ensure atomicity
        DB::beginTransaction();

        try {
            // First loop for creating MovementCommand records
            foreach ($data['number'] as $index => $value) {
                $row = MovementCommand::create([
                    'organized_by' => auth()->user()->name,
                    'number' => $data['number'],
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

                // If 'escort_id' is provided, insert into the movement_escorts table
                if (isset($data['escort_id']) && is_array($data['escort_id'])) {
                    foreach ($data['escort_id'] as $escort) {
                        DB::table('movement_escorts')->insert([
                            'escort_id' => $escort,
                            'mov_command_id' => $row->id,
                        ]);
                    }
                }
            }

            // Commit the transaction if everything is successful
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction if there's an error
            DB::rollBack();
            // Optionally log the exception or rethrow
            throw $e;
        }
    }
}
