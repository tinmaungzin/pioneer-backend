<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name'=>'VVIP',
            'allowed_people' => 5,
            'is_available' => 1
        ]);
        Type::create([
            'name'=>'UVIP',
            'allowed_people' => 5,
            'is_available' => 1
        ]);
        Type::create([
            'name'=>'LVIP',
            'allowed_people' => 5,
            'is_available' => 1
        ]);
        Type::create([
            'name'=>'VIP',
            'allowed_people' => 5,
            'is_available' => 1
        ]);
        Type::create([
            'name'=>'GA',
            'allowed_people' => 5,
            'is_available' => 1
        ]);
    }
}
