<?php

use Illuminate\Database\Seeder;

class VehiclefulldatasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Databases\Vehiclefulldata::class, 30)->create();
    }
}
