<?php

namespace App\Services\Escort;

use App\Models\Escort;

class UpdateEscortService
{
    public function updateEscort($request,$id=null)
    {
            $row = Escort::where('id',$id)->first();
            $license_type = array_key_exists('license_type', $request) ? $request['license_type'] : $row->license_type;
            $license_expiration_date = array_key_exists('license_expiration_date', $request) ? $request['license_expiration_date'] : $row->license_expiration_date;
            $row->update([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'birth_date' => $request['birth_date'],
                'phone' =>$request['phone'],
                'address' => $request['address'],
                'license_type' => $license_type,
                'license_expiration_date' => $license_expiration_date,
            ]);
        
    }
}
