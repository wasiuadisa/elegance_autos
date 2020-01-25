<?php

namespace App\Models\Databases;

use Illuminate\Database\Eloquent\Model;

class Vehiclefulldata extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'deleted', 'blocked', 'sold', 'vehicletypes_id', 'vehiclebrands_id', 'model', 'title', 'description', 'transmission', 'manufacture_date', 'maintenance_history', 'used', 'price', 'condition', 'mileage', 'customizations', 'modifications', 'engine_change', 'exterior_finish', 'exterior_colour', 'interior_finish', 'roof', 'accessories', 'tags', 'created_at', 'updated_at', 'view_count', 'integer_flag1', 'integer_flag2', 'integer_flag3', 'string_flag1', 'string_flag2', 'string_flag3'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'vehiclefulldatas';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
