<?php

namespace App\Services\Driver;

use App\Models\Driver;
use Carbon\Carbon;

class StoreDriverService
{
    public function storeDrivers(array $driversData)
    {
        foreach ($driversData['first_name'] as $index => $firstName) {
            Driver::create([
                'first_name' => $firstName,
                'last_name' => $driversData['last_name'][$index],
                'birth_date' => $driversData['birth_date'][$index],
                'phone' => $driversData['phone'][$index],
                'address' => $driversData['address'][$index],
                'license_type' => $driversData['license_type'][$index],
                'license_expiration_date' => $driversData['license_expiration_date'][$index],
            ]);
        }
    }
}
