<?php

namespace App\Models\Logic;

/** Added this for database Facade support
      as directed by 5.7 documentation
**/
use Illuminate\Support\Facades\DB;

// Import relevant database models
use App\Models\Databases\Vehiclefulldataimage;

class Images
{
   /**
     * Get a list of car images
     */
     public function images($id)
    {
        //Fetch a list of car images with given ID
        $images = Vehiclefulldataimage::where([ 
            ['vehiclefulldatas_id', '=', $id],
        ])->get();

        return $images;
    }

   /**
     * Get a list of car image filenames
     */
     public function imageFilenames($id)
    {
        //Fetch an images filename using given ID
        $images = Vehiclefulldataimage::where([ 
            ['vehiclefulldatas_id', '=', $id],
        ])->pluck('disk_image_filename');

        return $images;
    }

   /**
     * Get an image's filename
     */
     public function imagefilename($id)
    {
        //Fetch an image's filename using given ID
        $images = Vehiclefulldataimage::where([ 
            ['id', '=', $id],
        ])->pluck('disk_image_filename');

        return $images;
    }

   /**
     * Get an image's filename (different version)
     */
     public function imagefilename2($id)
    {
        $image = Vehiclefulldataimage::where([ 
            ['id', '=', $id],
        ])->first();

        return $image;
    }

   /**
     * Get an image total data from the image table
     */
     public function image($id)
    {
        //Fetch an image's data from the image table using given ID
        $image = Vehiclefulldataimage::where([ 
            ['id', '=', $id],
        ])->first();

        return $image;
    }

   /**
     * Get an vehicle's top or main image data from the image table
     */
     public function topImage($id)
    {
        $image = Vehiclefulldataimage::where('vehiclefulldatas_id', $id)
              ->orderBy('id', 'ASC')->first();

        return $image;
    }
    
   /**
     * Get a list of top car images
     */
     public function imagesList()
    {
        //Fetch a list of car images with given ID
        $images = Vehiclefulldataimage::where([ 
            ['vehiclefulldatas_id', '=', $id],
        ])->get();

        return $images;
    }

   /**
     * Delete images for a given car ID
     */
     public function deleteImages($id)
    {
        //Delete image with given ID
        return Vehiclefulldataimage::where([ 
                ['vehiclefulldatas_id', '=', $id],
            ])->delete();
    }

   /**
     * Delete a car's image entry using given image ID
     */
     public function deleteSingleImage($id)
    {
        //Delete image with given ID
        return Vehiclefulldataimage::where([ 
                ['id', '=', $id],
            ])->delete();
    }
}