<?php

namespace App\Models\Logic;

/** Added this for database Facade support
      as directed by 5.7 documentation
**/
use Illuminate\Support\Facades\DB;

// Import relevant database models
use App\Models\Databases\Eventimage;

class Eventimages
{
   /**
     * Get a list of event images
     */
     public function images($id)
    {
        //Fetch a list of event images with given ID
        $images = Eventimage::where([ 
            ['events_id', '=', $id],
        ])->get();

        return $images;
    }

   /**
     * Get a list of event image filenames
     */
     public function imageFilenames($id)
    {
        //Fetch an images filename using given ID
        $images = Eventimage::where([ 
            ['events_id', '=', $id],
        ])->pluck('disk_image_filename');

        return $images;
    }

   /**
     * Get an image's filename
     */
     public function imagefilename($id)
    {
        //Fetch an image's filename using given ID
        $image = Eventimage::where('events_id', $id)
              ->orderBy('id', 'ASC')->first();

        return $image;
    }

   /**
     * Get an image's filename (different version)
     */
     public function imagefilename2($id)
    {
        $image = Eventimage::where([ 
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
        $image = Eventimage::where([ 
            ['id', '=', $id],
        ])->first();

        return $image;
    }

   /**
     * Delete images for a given event ID
     */
     public function deleteImages($id)
    {
        //Delete image with given ID
        return Eventimage::where([ 
                ['events_id', '=', $id],
            ])->delete();
    }

   /**
     * Delete an event's image entry using given image ID
     */
     public function deleteSingleImage($id)
    {
        //Delete image with given ID
        return Eventimage::where([ 
                ['id', '=', $id],
            ])->delete();
    }

}