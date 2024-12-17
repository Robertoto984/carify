<?php

namespace App\Services\Driver;

use App\Models\Driver;
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

    public function updateDrivers($request,$id=null)
    {
            $row = Driver::where('id',$id)->first();
            $row->update([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'birth_date' => $request['birth_date'],
                'phone' =>$request['phone'],
                'address' => $request['address'],
                'license_type' => $request['license_type'],
                'license_expiration_date' => $request['license_expiration_date'],
            ]);
        
    }
}
