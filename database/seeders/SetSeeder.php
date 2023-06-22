<?php

namespace Database\Seeders;

use App\Models\Set;
use Illuminate\Database\Seeder;

class SetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Set::create([
            'name' => 'Set A'
        ]);

        Set::create([
            'name' => 'Set B'
        ]);
    }
}
