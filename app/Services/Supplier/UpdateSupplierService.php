<?php

namespace App\Services\Supplier;

use App\Models\Supplier;

class UpdateSupplierService
{
    public function update(array $data, $id)
    {
        $row = Supplier::findOrFail($id);

        $row->update([
            'name' => $data['name'] ?? null,
            'trade_name' => $data['trade_name'] ?? null,
            'address' => $data['address'],
            'email' => $data['email'] ?? null,
            'phone_1' => $data['phone_1'] ?? null,
            'phone_2' => $data['phone_2'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);
    }
}
