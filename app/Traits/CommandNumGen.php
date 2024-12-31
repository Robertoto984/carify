<?php

namespace App\Traits;

use App\Models\MaintenanceOrder;
use App\Models\MaintenanceRequest;
use Carbon\Carbon;
use App\Models\MovementCommand;

trait CommandNumGen
{
    public function generateCustomNumber()
    {
        $date = Carbon::now()->format('dm');

        $lastCommand = MovementCommand::where('number', 'like', 'os' . $date . '%')
            ->orderBy('number', 'desc')
            ->first();

        $increment = 1;
        if ($lastCommand) {
            $lastNumber = substr($lastCommand->number, 6);
            if (is_numeric($lastNumber)) {
                $increment = (int)$lastNumber + 1;
            }
        }
        return 'os' . $date . sprintf('%04d', $increment);
    }

    public function generateMaintenanceOrderNumber()
    {
        $date = Carbon::now()->format('dm');

        $lastCommand = MaintenanceRequest::where('number', 'like', 'mo' . $date . '%')
            ->orderBy('number', 'desc')
            ->first();

        $increment = 1;
        if ($lastCommand) {
            $lastNumber = substr($lastCommand->number, 6);
            if (is_numeric($lastNumber)) {
                $increment = (int)$lastNumber + 1;
            }
        }
        return 'mo' . $date . sprintf('%04d', $increment);
    }
}
