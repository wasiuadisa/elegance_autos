<?php

namespace App\Models\Databases;

use Illuminate\Database\Eloquent\Model;

class Vehiclefulldataimage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'deleted', 'blocked', 'vehiclefulldatas_id', 'caption', 'disk_image_filename', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'vehiclefulldataimages';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
