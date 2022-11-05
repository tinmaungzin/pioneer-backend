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
            'name'=>'VIP',
            'allowed_people' => 5,
        ]);
        Type::create([
            'name'=>'LVIP',
            'allowed_people' => 5,
        ]);
        Type::create([
            'name'=>'UVIP',
            'allowed_people' => 5,
        ]);
        Type::create([
            'name'=>'WWIP',
            'allowed_people' => 5,
        ]);
    }
}
