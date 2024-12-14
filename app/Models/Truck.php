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

    public function drivers()
    {
        return $this->belongsToMany(Driver::class, 'truck_driver', 'truck_id', 'driver_id')
                    ->withPivot('receipt_date', 'deliver_date');
    }
}
