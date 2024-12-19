<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $guarded = [];

    protected $casts = [
        'color' => 'string',
        'fuel_type' => 'string',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function truckDeliverCards()
    {
        return $this->hasMany(TruckDeliverCard::class);
    }

}
