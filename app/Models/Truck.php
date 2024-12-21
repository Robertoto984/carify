<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function setYearAttribute($value)
    {
        $this->attributes['year'] = Carbon::parse($value)->format('Y');
    }

    public function setRegisterAttribute($value)
    {
        $this->attributes['register'] = Carbon::parse($value)->format('Y');
    }

    public function setModelAttribute($value)
    {
        $this->attributes['model'] = Carbon::parse($value)->format('Y');
    }

    public function setDemarcationDateAttribute($value)
    {
        $this->attributes['demarcation_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function truckDeliverCards()
    {
        return $this->hasMany(TruckDeliverCard::class);
    }

}
