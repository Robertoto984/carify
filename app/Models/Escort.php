<?php

namespace App\Models;

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
        return \Carbon\Carbon::parse($value)->toDateString();
    }

    public function getLicenseExpirationDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->toDateString();
    }
}
