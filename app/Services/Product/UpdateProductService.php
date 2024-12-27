<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class UpdateProductService
{
    public function update(array $data, $id)
    {
        $row = Product::findOrFail($id);

        // Ensure that 'code' is required and not null
        if (empty($data['code'])) {
            // Handle error: code is required
            throw new \Exception("Code cannot be empty.");
        }

        $row->update([
            'code' => $data['code'], // 'code' cannot be null
            'name' => $data['name'] ?? null,
            'qty' => (float) ($data['qty'] ?? 0),
            'origin_country' => $data['origin_country'] ?? null,
            'production_date' => $data['production_date'] ?? null,
            'expireation_date' => $data['expireation_date'] ?? null,
            'supplier_id' => (int) ($data['supplier_id'][0] ?? null),
            'notes' => $data['notes'] ?? null,
        ]);
    }
}
