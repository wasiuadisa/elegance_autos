<?php

use Illuminate\Database\Seeder;

class VehiclefulldataimagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Databases\Vehiclefulldataimage::class, 4)->create();
    }
}
