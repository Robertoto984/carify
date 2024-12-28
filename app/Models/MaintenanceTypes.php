<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MaintenanceTypes extends Model
{
    protected $fillable = ['name'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at);
    }


    public function getUpdatedAtFormattedAttribute()
    {
        return Carbon::parse($this->updated_at);
    }

    public function maintenanceOrders()
    {
        return $this->belongsToMany(MaintenanceOrder::class, 'maintenance_order_maintenance_type');
    }
}
