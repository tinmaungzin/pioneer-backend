<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run()
    {
        Staff::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'staff_type_id' => 1,
            'password' => 'password'
        ]);

        Staff::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'staff_type_id' => 2,
            'password' => 'password'
        ]);
    }
}
