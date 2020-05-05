<?php

namespace App\Models\Logic;

/** Added this for database Facade support
      as directed by 5.7 documentation
**/
use Illuminate\Support\Facades\DB;

// Import relevant database models
use App\Models\Databases\Vehiclebrand;

class Brands
{   
   /**
     * Get list of car brands
     */
     public function brands()
    {
        //Fetch a site URL with given ID
        $brands = Vehiclebrand::orderBy('name', 'asc')->get();

        return $brands;
    }

   /**
     * Get list of car brands
     */
    public function carBrands($length)
    {
        //Fetch all car brands
        $brands = Vehiclebrand::orderBy('name', 'asc')->paginate($length);

        return $brands;
    }

   /**
     * Get car brand name
     */
     public function brandName($id)
    {
        //Fetch car brand name
        $brands = Vehiclebrand::where([ ['id', '=', $id], ])->value('name');
        return $brands;
    }

   /**
     * Delete a vehicle brand using category id
     */
    public function brandDelete($id)
    {
        //Delete a vehicle brand
        Vehiclebrand::where([
            ['id', '=', $id]
        ])->delete();
    }
}
