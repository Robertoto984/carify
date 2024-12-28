<?php

namespace App\Services\Product;

use App\Models\Product;

class StoreProductService
{
    public function store(array $products)
    {
        $productData = [];
        foreach ($products['code'] as $key => $value) {
            $productData[] = [
                'code' => $value,
                'name' => $products['name'][$key],
                'qty' => $products['qty'][$key],
                'price' => $products['price'][$key],
                'origin_country' => $products['origin_country'][$key],
                'production_date' => $products['prod_date'][$key],
                'expireation_date' => $products['exp_date'][$key],
                'supplier_id' => $products['supplier_id'][$key],
                'notes' => $products['notes'][$key],
            ];
        }

        Product::insert($productData);
    }
}
