<?php

namespace App\Models\Logic;

/** Added this for database Facade support
      as directed by 5.7 documentation
**/
use Illuminate\Support\Facades\DB;

// Import relevant database models
use App\Models\Databases\Event;

//This import is essential to manipulating files in the directory
use Illuminate\Support\Facades\File;

class Events
{
   /**
     * Update view count of a event with given ID
     */
    public function viewsCountUpdate( $id )
    {
        //Fetch a event's title using given ID
        //Event::where(['id', '=', $id])->increment('view_count');//update(['view_count' => 'view_count' + 1]);

        //DB::update('update events set view_count = view_count + 1 where id = ?', $id);

        //DB::table('events')->increment('view_count')->where(['id', '=', $id]);
    }

   /**
     * Get title of an event with given ID
     */
    public function eventsWithID( $id )
    {
        //Fetch an event's title using given ID
        $posts = Event::where([
          ['deleted', '=', 0], ['blocked', '=', 0], ['id', '=', $id]
        ])->get('title'); 

        return $posts;
    }

   /**
     * Get an event's data using given ID 
     */
     public function event( $id )
    {
        //Fetch a event's data using given ID  
//        $event = Event::where('deleted', '=', 0)->where('blocked', '=', 0)->where('id', '=', $id)->first();
        $event = Event::where('deleted', '=', 0)->where('id', '=', $id)->first();

        return $event;
    }

   /**
     * Get list of events
     */
    public function events($length)
    {
        //Fetch list of used vehicles
        $list = Event::where([
        //    ['blocked', '=', 0], ['deleted', '=', 0],
            ['deleted', '=', 0],
        ])->orderBy('id', 'desc')->paginate($length);

        return $list;
    }

   /**
     * Mark an event as blocked
     */
    public function eventBlock( $id )
    {
        //Mark the entry for this event in the event table as blocked
        Event::where([
            ['id', '=', $id]
        ])->update([ 'blocked' => 1, ]);
    }

   /**
     * Mark an event as Unblocked
     */
    public function eventUnBlock( $id )
    {
        //Mark the entry for this event in the event table as blocked
        Event::where([
            ['id', '=', $id]
        ])->update([ 'blocked' => 0, ]);
    }

   /**
     * Delete an event as well as any associated photo
     */
    public function eventDelete( $id )
    {
        /* First, get all image file names for the given event ID in the images table */
        $imagesFileNames = (new \App\Models\Logic\Eventimages)->imageFilenames($id);

        /* Next, for each filename found, remove or delete the file from the images directory */
        foreach ($imagesFileNames as $imageFile)
        {
            unlink(public_path('Events/' . $imageFile));
        }

        //Now, delete every entry of that image for the event in the images table
        (new \App\Models\Logic\Eventimages)->deleteImages($id);

        //Lastly, delete the entry for this event in the event table
        Event::where([
            ['id', '=', $id]
    //    ])->update([ 'sold' => 1, ]);
        ])->delete();
    }
}
