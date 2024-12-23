<?php

namespace App\Services\Driver;

use App\Models\Driver;
class UpdateDriverService
{

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
