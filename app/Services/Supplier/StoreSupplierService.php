<?php

namespace App\Services\Supplier;

use App\Models\Supplier;

class StoreSupplierService
{
    public function store(array $suppliers)
    {
        $supplierData = [];
        foreach ($suppliers['address'] as $key => $value) {
            $supplierData[] = [
                'name' => $suppliers['name'][$key] ?? null,
                'trade_name' => $suppliers['trade_name'][$key] ?? null,
                'address' => $value,
                'email' => $suppliers['email'][$key] ?? null,
                'phone_1' => $suppliers['phone_1'][$key],
                'phone_2' => $suppliers['phone_2'][$key] ?? null,
                'notes' => $suppliers['notes'][$key] ?? null,
            ];
        }

        Supplier::insert($supplierData);
    }
}
