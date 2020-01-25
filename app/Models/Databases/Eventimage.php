<?php

namespace App\Models\Databases;

use Illuminate\Database\Eloquent\Model;

class Eventimage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'deleted', 'blocked', 'events_id', 'caption', 'disk_image_filename', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'eventimages';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
