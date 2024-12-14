<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TruckDeliverCard extends Model
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
}
