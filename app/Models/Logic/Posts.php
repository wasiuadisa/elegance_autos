<?php

namespace App\Models\Logic;

/** Added this for database Facade support
      as directed by 5.7 documentation
**/
use Illuminate\Support\Facades\DB;

// Import relevant database models
use App\Models\Databases\Vehiclefulldata;

//This import is essential to manipulating files in the directory
use Illuminate\Support\Facades\File;

class Posts
{
   /**
     * Update view count of a post with given ID
     */
    public function viewsCountUpdate( $id )
    {
        //Fetch a car's title using given ID
        //Vehiclefulldata::where(['id', '=', $id])->increment('view_count');//update(['view_count' => 'view_count' + 1]);

        //DB::update('update autobarnposts set view_count = view_count + 1 where id = ?', $id);

        //DB::table('autobarnposts')->increment('view_count')->where(['id', '=', $id]);
    }

   /**
     * Get title of a car with given ID
     */
    public function postsWithID( $id )
    {
        //Fetch a car's title using given ID
        $posts = Vehiclefulldata::where([
          ['deleted', '=', 0], ['blocked', '=', 0], ['id', '=', $id]
        ])->get('title'); 

        return $posts;
    }

   /**
     * Get a car's data using given ID 
     */
     public function post( $id )
    {
        //Fetch a car's data using given ID  
        $post = Vehiclefulldata::where('deleted', '=', 0)->where('blocked', '=', 0)->where('id', '=', $id)->first();

        return $post;
    }

   /**
     * Get list of vehicles
     */
    public function posts($length)
    {
        //Fetch list of used vehicles
        $useds = Vehiclefulldata::where([
            ['blocked', '=', 0], ['deleted', '=', 0],
        ])->orderBy('id', 'desc')->paginate($length);

        return $useds;
    }

   /**
     * Count all vehicles
     */
    public function countPosts()
    {
        $count = Vehiclefulldata::where([
            ['blocked', '=', 0], ['deleted', '=', 0],
        ])->count();

        return $count;
    }

   /**
     * Count all vehicles of a similar type
     */
    public function countPostTypes($id)
    {
        $count = Vehiclefulldata::where([
            ['blocked', '=', 0], ['deleted', '=', 0], ['vehicletypes_id', '=', $id],
        ])->count();

        return $count;
    }

   /**
     * Get list of sold vehicles
     */
    public function postsSold($length)
    {
        //Fetch list of used vehicles
        $useds = Vehiclefulldata::where([
            ['blocked', '=', 0], ['deleted', '=', 0], ['sold', '=', 1]
        ])->orderBy('id', 'desc')->paginate($length);

        return $useds;
    }

   /**
     * Get list of used vehicles
     */
    public function postsUsed($length)
    {
        //Fetch list of used vehicles
        $useds = Vehiclefulldata::where([
            ['blocked', '=', 0], ['deleted', '=', 0], ['used', '=', 'Used']
        ])->orderBy('id', 'desc')->paginate($length);

        return $useds;
    }

   /**
     * Get list of new vehicles 
     */
    public function postsNew($length)
    {
        //Fetch list of new vehicles
        $useds = Vehiclefulldata::where([
            ['blocked', '=', 0], ['deleted', '=', 0], ['used', '=', 'New']
        ])->orderBy('id', 'desc')->paginate($length);

        return $useds;
    }

   /**
     * Mark a vehicle as sold
     */
    public function postMarkAsSold( $id )
    {
        /* Mark a vehicle as sold */
        Vehiclefulldata::where([
            ['blocked', '=', 0], ['deleted', '=', 0], ['id', '=', $id]
        ])->update([ 'sold' => 1, ]);
    }

   /**
     * Delete a vehicle as well as any associated photo
     */
    public function postDelete( $id )
    {
        /* First, get all image file names for the given post ID in the images table */
        $imagesFileNames = (new \App\Models\Logic\Images)->imageFilenames($id);

        /* Next, for each filename found, remove or delete the file from the images directory */
        foreach ($imagesFileNames as $imageFile)
        {
            unlink(public_path('/VehiclesInStock/images/' . $imageFile));
        }

        //Now, delete every entry of that images for the post in the images table
        (new \App\Models\Logic\Images)->deleteImages($id);

        //Lastly, delete the entry for this post in the car table
        Vehiclefulldata::where([
            ['id', '=', $id]
    //    ])->update([ 'sold' => 1, ]);
        ])->delete();
    }

   /**
     * Get list of cars of a type
     */
    public function categoryPosts( $length, $typeId )
    {
        /* Category script begins here */
        $categoryPosts = Vehiclefulldata::where([
            ['blocked', '=', 0], ['deleted', '=', 0], ['vehicletypes_id', '=', $typeId]
        ])->orderBy('id', 'desc')->paginate($length);

        return $categoryPosts;
    }
}
