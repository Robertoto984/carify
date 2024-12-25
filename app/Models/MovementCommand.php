<?php

namespace App\Models;

use App\Traits\CommandNumGen;
use Illuminate\Database\Eloquent\Model;

class MovementCommand extends Model
{
    use CommandNumGen;

    protected $guarded = [];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function escort()
    {
        return $this->belongsToMany(Escort::class, 'movement_escorts', 'mov_command_id', 'escort_id');
    }

    protected static function booted()
    {
        static::creating(function ($command) {
            $command->number = $command->generateCustomNumber();
        });
    }
}
