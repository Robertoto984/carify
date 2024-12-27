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

    public function statusButton()
    {
        return $this->status == 1 ?
        '<a id="modal" type="button" data-toggle="modal" data-target="#exampleModal" href="' . route('commands.finish', $this->id) . '" class="btn btn-success btn-sm">
                                                <i class="fa-regular fa-circle-check"></i> إنهاء
                                            </a>' :

        '<span   href="" class="btn btn-warning btn-sm">
                                            <i class="fa-regular fa-circle-check"></i> منتهية
                                        </span>';
    }

    public function status()
    {
        return $this->status == 1 ? 'قيد التنفيذ':'منتهية';

    }

    protected static function booted()
    {
        static::creating(function ($command) {
            $command->number = $command->generateCustomNumber();
        });
    }
}
