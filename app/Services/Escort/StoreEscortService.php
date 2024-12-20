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

    // public function updateDrivers($request,$id=null)
    // {
    //         $row = Escort::where('id',$id)->first();
    //         $row->update([
    //             'first_name' => $request['first_name'],
    //             'last_name' => $request['last_name'],
    //             'birth_date' => $request['birth_date'],
    //             'phone' =>$request['phone'],
    //             'address' => $request['address'],
    //             'license_type' => $request['license_type'],
    //             'license_expiration_date' => $request['license_expiration_date'],
    //         ]);
        
    // }
}
