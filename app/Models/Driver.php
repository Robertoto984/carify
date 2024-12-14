<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $guarded =[];

    public function trucks()
    {
        return $this->belongsToMany(Truck::class, 'truck_driver', 'driver_id', 'truck_id')
                    ->withPivot('receipt_date', 'deliver_date');
    }

}
