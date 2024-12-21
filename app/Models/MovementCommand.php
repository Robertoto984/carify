<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovementCommand extends Model
{
    protected $guarded = [];

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function escort()
    {
        return $this->belongsToMany(Escort::class, 'movement_escorts','mov_command_id','id');
    }

}
