<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Escort extends Model
{
    protected $guarded = [];

    protected $casts = [
        'license_type' => 'string',
        'birth_date' => 'date',
        'license_expiration_date' => 'date',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function getBirthDateAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getLicenseExpirationDateAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function movements()
    {
        return $this->belongsToMany(MovementCommand::class, 'movement_escorts', 'escort_id', 'mov_command_id');
    }
}
