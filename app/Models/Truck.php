<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $guarded = [];

    protected $casts = [
        'color' => 'string',
        'fuel_type' => 'string',
    ];

    public function truckDeliverCards()
    {
        return $this->hasMany(TruckDeliverCard::class);
    }

}
