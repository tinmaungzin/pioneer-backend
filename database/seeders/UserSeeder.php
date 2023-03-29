<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'User',
            'phone_number' => '09961996949',
            'user_type_id' => 1,
            'password' => 'password',
            'balance' => 10000000
        ]);

        User::create([
            'name' => 'Saleperson',
            'phone_number' => '09111111111',
            'user_type_id' => 2,
            'password' => 'password'
        ]);
    }
}
