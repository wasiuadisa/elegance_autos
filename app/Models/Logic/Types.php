<?php

namespace App\Models\Logic;

/** Added this for database Facade support
      as directed by 5.7 documentation
**/
use Illuminate\Support\Facades\DB;

// Import relevant database models
use App\Models\Databases\Vehicletype;

class Types
{
   /**
     * Get list of car categories
     */
    public function types()
    {
        //Fetch all car categories
        $types = Vehicletype::orderBy('name', 'asc')->get();

        return $types;
    }

   /**
     * Get list of car genres/types
     */
    public function carTypes($length)
    {
        //Fetch all car genres/types
        $types = Vehicletype::orderBy('name', 'asc')->paginate($length);

        return $types;
    }

   /**
     * Get car category name
     */
    public function typeName($id)
    {
        //Fetch car category name
        $types = Vehicletype::where([ ['id', '=', $id], ])->value('name');
        return $types;
    }

   /**
     * Get car category id
     */
    public function typeId($categoryName)
    {
        //Fetch car category name
        $types = Vehicletype::where([ ['name', '=', $categoryName], ])->value('id');
        return $types;
    }

   /**
     * Delete a vehicle type/genres using category id
     */
    public function typeDelete($id)
    {
        //Delete a vehicle type/genres
        Vehicletype::where([
            ['id', '=', $id]
        ])->delete();
    }
}
