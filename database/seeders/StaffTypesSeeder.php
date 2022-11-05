<?php

namespace Database\Seeders;

use App\Models\StaffType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StaffType::create([
            'name'=>'admin',
        ]);
        StaffType::create([
            'name'=>'receptionist',
        ]);
    }
}
