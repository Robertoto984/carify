<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceOrder extends Model
{
    protected $casts = [
        'type' => 'string',
    ];

    protected $guarded = [];

    public function maintenanceTypes()
    {
        return $this->belongsToMany(maintenanceTypes::class, 'maintenance_order_maintenance_type');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_maintenance_order')
            ->withPivot('quantity', 'unit_price', 'total_price');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }
}
