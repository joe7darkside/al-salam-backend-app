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
        // \App\Models\User::factory(10)->create();
        // \App\Models\Bill::factory(10)->create();
        \App\Models\Trip::factory(10)->create();
        // \App\Models\Invitation::factory(10)->create();
        // \App\Models\Captain::factory(10)->create();
        // \App\Models\WaterBill::factory(30)->create();
        // \App\Models\GasBill::factory(30)->create();
        // \App\Models\ElectricityBill::factory(30)->create();
    }
}
