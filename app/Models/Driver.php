<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $guarded =[];

    protected $casts = [
        'birth_date' => 'date',
        'license_expiration_date' => 'date',
    ];

     public function getBirthDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->toDateString();
    }

    public function getLicenseExpirationDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->toDateString();
    }

    public function truckDeliverCards()
    {
        return $this->hasMany(TruckDeliverCard::class);
    }
}
