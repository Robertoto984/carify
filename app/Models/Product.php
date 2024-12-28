<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function maintenanceOrders()
    {
        return $this->belongsToMany(MaintenanceOrder::class, 'product_maintenance_order')
            ->withPivot('quantity', 'unit_price', 'total_price');
    }
}
