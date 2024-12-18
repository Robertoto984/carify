<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            ['name'=>'مدير'],
            ['name'=>'مستخدم عادي']
        ];

        DB::table('roles')->insert($arr);
    }
}
