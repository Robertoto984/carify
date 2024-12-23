<?php

namespace App\Services\Escort;

use App\Models\Escort;
class StoreEscortService
{
    public function storeEscorts(array $data)
    {
        foreach ($data['first_name'] as $index => $first_name) {
            Escort::create([
                'first_name' => $first_name,
                'last_name' => $data['last_name'][$index],
                'birth_date' => $data['birth_date'][$index],
                'phone' => $data['phone'][$index],
                'address' => $data['address'][$index],
                'license_type' => $data['license_type'][$index] ?? null,
                'license_expiration_date' => $data['license_expiration_date'][$index] ?? null,
            ]);
        }
    }

  
}
