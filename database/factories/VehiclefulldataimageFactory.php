<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Databases\Vehiclefulldataimage::class, function (Faker $faker) {
    return [
    	'deleted' => 0,
    	'blocked' => 0,
    	'vehiclefulldatas_id' => 30,//$faker->numberBetween(1, 70),
	    'caption' => $faker->words($nb = 7, $asText = true),
	    'disk_image_filename' => $faker->file($sourceDir = 'C:\Program Files\Ampps\www\EleganceAutosBackEnd\public\images\portfolio\thumb', $targetDir = 'C:\Program Files\Ampps\www\EleganceAutosBackEnd\public\VehiclesInStock\images', false),
	    'created_at' => $faker->dateTime($max = 'now', $timezone = null),
	    'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});
