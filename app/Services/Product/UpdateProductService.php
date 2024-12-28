<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class UpdateProductService
{
    public function update(array $data, $id)
    {
        $row = Product::findOrFail($id);

        if (empty($data['code'])) {
            throw new \Exception("Code cannot be empty.");
        }

        $row->update([
            'code' => $data['code'],
            'name' => $data['name'] ?? null,
            'qty' => (float) ($data['qty'] ?? 0),
            'price' => (float) ($data['price'] ?? 0),
            'origin_country' => $data['origin_country'] ?? null,
            'production_date' => $data['production_date'] ?? null,
            'expireation_date' => $data['expireation_date'] ?? null,
            'supplier_id' => (int) ($data['supplier_id'][0] ?? null),
            'notes' => $data['notes'] ?? null,
        ]);
    }
}
