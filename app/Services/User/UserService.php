<?php
namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store(array $users)
    {
 
        foreach ($users['name'] as $index => $value) {
            User::create([
                'name'=>$value,
                'email'=>$users['email'][$index],
                'password'=>$users['password'][$index],
                'role_id'=>$users['role_id'][$index]
            ]);
        }
    }
    public function update($request, $id = null)
    {
        $row = User::where('id', $id)->first();
        if (empty($request['password'])) {
            unset($request['password']);
        }
        $request['password'] = Hash::make($request['password']);
      
        $row->update($request);
    }
}
