<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Databases\Vehiclefulldata::class, function (Faker $faker) {

    $maintenance_history_array = array('Yes', 'No');
    $random_maintenance_history = array_rand($maintenance_history_array);
    $maintenance_history = $maintenance_history_array[$random_maintenance_history];

    $modifications_array = array('', 'badnkn ', 'bjnajsbc dakjbad', ' a ddj');
    $random_modifications = array_rand($modifications_array);
    $modifications = $modifications_array[$random_modifications];

    $used_array = array('Yes', 'No');
    $random_used = array_rand($used_array);
    $used = $used_array[$random_used];

    $engine_change_array = array('Yes', 'No');
    $random_engine_change = array_rand($engine_change_array);
    $engine_change = $engine_change_array[$random_engine_change];

    $customizations_array = array('Yes', 'No');
    $random_customizations = array_rand($customizations_array);
    $customizations = $customizations_array[$random_customizations];

    $roof_array = array('Covered','Sun-roof','Moon-roof','Convertible');
    $random_roof = array_rand($roof_array);
    $roof = $roof_array[$random_roof];

    $condition_array = array('Drive-off', 'Tow-away');
    $random_condition = array_rand($condition_array);
    $condition = $condition_array[$random_condition];

    $accessories_array = array('Tool-box','Jack','Caution-signs','Manual');
    $random_accessories = array_rand($accessories_array);
    $accessories = $accessories_array[$random_accessories];

    $transmission_array = array('Automatic', 'Manual', 'Hybrid');
    $random_transmission = array_rand($transmission_array);
    $transmission = $transmission_array[$random_transmission];

    $interior_finish_array = array('Leather', 'Fabric');
    $random_interior_finish = array_rand($interior_finish_array);
    $interior_finish = $interior_finish_array[$random_interior_finish];

    $exterior_finish_array = array('Factory-paint','Repaint');
    $random_exterior_finish = array_rand($exterior_finish_array);
    $exterior_finish = $exterior_finish_array[$random_exterior_finish];

    return [
    	'deleted' => 0,
    	'blocked' => 0,
    	'sold' => 0,
    	'vehicletypes_id' => $faker->numberBetween(1, 11),
    	'vehiclebrands_id' => $faker->numberBetween(1, 50),
    	'model' => $faker->name,
    	'title' => $faker->words($nb = 7, $asText = true),
    	'description' => $faker->words($nb = 100, $asText = true),
    	'transmission' => $transmission,
    	'manufacture_date' => $faker->numberBetween(1980, 2018),
    	'maintenance_history' => $maintenance_history,
    	'used' => $used,
    	'price' => $faker->numberBetween(1980, 37892018),
    	'condition' => $condition,
    	'mileage' => $faker->numberBetween(198, 92018),
    	'customizations' => $customizations,
    	'modifications' => $modifications,
    	'engine_change' => $engine_change,
    	'exterior_finish' => $exterior_finish,
    	'exterior_colour' => $faker->words($nb = 2, $asText = true),
    	'interior_finish' => $interior_finish,
    	'roof' => $roof,
    	'accessories' => $accessories,
    	'tags' => $faker->words($nb = 10, $asText = true),
    	'created_at' => $faker->dateTime($max = 'now', $timezone = null),
    	'updated_at' => $faker->dateTimeBetween('now', '+3 months'),
    	'view_count' => 0,
    	'integer_flag1' => 0,
    	'integer_flag2' => 0,
    	'integer_flag3' => 0,
    	'string_flag1' => "",
    	'string_flag2' => "",
    	'string_flag3' => "" 
    ];
});
