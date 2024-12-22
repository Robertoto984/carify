<?php

namespace App\Traits;

use App\Models\MovementCommand;
use Carbon\Carbon;

trait CommandNumGen
{
    public function generateCustomNumber()
    {
        $date = Carbon::now()->format('dmy');
        $lastCommand = MovementCommand::where('number', 'like', 'os' . $date . '%')
            ->orderBy('number', 'desc')
            ->first();

        $increment = 1;
        if ($lastCommand) {
            $lastNumber = substr($lastCommand->custom_number, 6);
            $increment = (int) $lastNumber + 1;
        }

        return 'os' . $date . sprintf('%04d', $increment);
    }
}
