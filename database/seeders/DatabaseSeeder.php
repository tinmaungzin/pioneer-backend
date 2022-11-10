<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StaffTypesSeeder::class);
        $this->call(TypesSeeder::class);
        $this->call(UserTypesSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SetSeeder::class);
    }
}
