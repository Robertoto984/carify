<?php
  
namespace App\Imports;
  
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Hash;
  
class UsersImport implements ToModel
{
    private $counter =0;

    public function model(array $row)
    {
        $this->counter ++;
        
        if ($this->counter > 1) {
            if (empty($row[0])) {
                return null;
            }

            $user = new User();
            $user->name = $row[0];
            $user->email = $row[1];
            $user->role_id = $row[2];
           
            $user->save();
        }
    }
}
