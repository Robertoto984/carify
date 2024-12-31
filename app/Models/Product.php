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

    public function request()
    {
        return $this->belongsToMany(MaintenanceRequest::class, 'request_product', 'product_id', 'request_id');
    }
}
