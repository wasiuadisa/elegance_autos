<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/** Added this for database Facade support
      as directed by 5.7 documentation
**/
use Illuminate\Support\Facades\DB;

//Import requests
use App\Http\Requests\EleganceFormRequest;
use App\Http\Requests\EleganceImageFormRequest;
use App\Http\Requests\EleganceImageFormEditRequest;

//Import database models
use App\Models\Databases\Vehicletype;
use App\Models\Databases\Vehiclebrand;
use App\Models\Databases\Vehiclefulldata;
use App\Models\Databases\Vehiclefulldataimage;

//This is for deleting files from disk
//use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CarsController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the new post form.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newCarForm()
    {
        /*  List of vehicle types begins here */
        $vehicletypes = (new \App\Models\Logic\Types)->types();
        
        /*  List of vehicle brands begins here */
        $vehiclebrands = (new \App\Models\Logic\Brands)->brands();

        $categoryLists = $vehicletypes;

        return view('AdminArea.CreateNewVehicle', [
            'vehicletypes' => $vehicletypes, 'vehiclebrands' => $vehiclebrands, 'categoryLists' => $categoryLists,
        ]);
    }

    /**
     * Post the new form data to database table.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newCarFormPost(EleganceFormRequest $request)
    {
        //Instanstiate Autobarnpost input class model
        $newposts               = new Vehiclefulldata;

        //Sanitize inputs
        $newposts->deleted      = 0;
        $newposts->blocked      = 0;
        $newposts->sold         = 0;
        $newposts->vehicletypes_id  = filter_var($request->input('VehicleType'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->vehiclebrands_id = filter_var($request->input('Brand'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->model            = filter_var($request->input('Model'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);

        $newposts->title            = filter_var($request->input('Title'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->description      = filter_var($request->input('Description'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->transmission     = filter_var($request->input('Transmission'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->manufacture_date = filter_var($request->input('ManufactureDate'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->maintenance_history = filter_var($request->input('MaintenanceHistory'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->used             = filter_var($request->input('UsedOrNew'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->price            = filter_var($request->input('Price'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);

        $newposts->condition        = filter_var($request->input('Condition'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->mileage          = filter_var($request->input('Mileage'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->customizations   = filter_var($request->input('Customizations'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->modifications    = filter_var($request->input('Modifications'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->engine_change    = filter_var($request->input('EngineChange'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->exterior_finish  = filter_var($request->input('ExteriorFinish'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->exterior_colour  = filter_var($request->input('ExteriorColour'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->interior_finish  = filter_var($request->input('InteriorFinish'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->roof             = filter_var($request->input('Roof'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->accessories      = filter_var($request->input('Accessories'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->tags             = filter_var($request->input('Tags'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newposts->created_at       = now();
        $newposts->updated_at       = now();
        $newposts->view_count       = 0;
        $newposts->integer_flag1    = 0;
        $newposts->integer_flag2    = 0;
        $newposts->integer_flag3    = 0;
        $newposts->string_flag1     = "";
        $newposts->string_flag2     = "";
        $newposts->string_flag3     = "";
        $newposts->save();

        session()->flash('infoStatus', 'Good Job! The new car post has been created, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('newCarImageForm', [ $newposts->id, ]);
    }

    /**
     * Show form for post's image.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newCarImageForm($id)
    {
        /*  List of vehicle types begins here */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        return view('AdminArea.CreateNewVehicleImage', [
            'post_id' => $id, 'categoryLists' => $categoryLists,
        ]);
    }

    /**
     * Process new photo image upload
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newCarImageFormPost(EleganceImageFormRequest $request)
    {
        $image = $request->file('file');
        $hashedName = hash('ripemd160', time()).'.'.$image->getClientOriginalExtension(); 
        $destinationPath = public_path('/VehiclesInStock/images/');
        $image->move($destinationPath, $hashedName);

        //Instantiate post image input class model
        $newpostimages                      = new Vehiclefulldataimage;

        //Sanitize inputs
        $newpostimages->blocked             = 0;
        $newpostimages->deleted             = 0;
        $newpostimages->vehiclefulldatas_id = filter_var($request->input('PostID'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newpostimages->caption             = filter_var($request->input('Caption'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newpostimages->disk_image_filename = $hashedName;
        $newpostimages->created_at          = now();
        $newpostimages->updated_at          = now();
        $newpostimages->save();

        //This is the message to display        
        session()->flash('infoStatus', 'Good Job! The new car post photo has been uploaded, successfully.');

        //Redirect to a routes name
        return redirect()->route('newCarImageForm', [ $request->input('PostID'), ]);
    }
/*
    public function newCarImageFormPost(Request $request)
    {
        $this->validate($request, [
            //This form data go in the post's image table
            'PostID'    => 'required|integer',
//            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'file'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
//            'file'          => 'required|image|size:5120', //5120 = 5mb
            'Caption'   => 'required|string|between:0,200',
        ]);

        if ($request->hasFile('file'))
        {
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/VehiclesInStock/images/');
            $image->move($destinationPath, $name);

            //Instanstiate Autobarnpost image input class model
            $newpostimages               = new Vehiclefulldataimage;

            //Sanitize inputs
            $newpostimages->vehiclefulldatas_id = filter_var($request->input('PostID'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);

            $newpostimages->blocked             = 0;
            $newpostimages->deleted             = 0;
            $newpostimages->caption             = filter_var($request->input('Caption'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
            $newpostimages->created_at       = now();
            $newpostimages->updated_at       = now();
            $newpostimages->save();

            return back()->with('infoStatus', 'Good Job! The new car post photo has been uploaded, successfully.');
        }
    }
*/

    /**
     * Show form for editing existing post.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editCarForm($id)
    {
        /*  Vehicles full data here */
        $vehicles = (new \App\Models\Logic\Posts)->post($id);

        /*  List of vehicle types begins here */
        $vehicletypes = (new \App\Models\Logic\Types)->types();

        /*  List of vehicle brands begins here */
        $vehiclebrands = (new \App\Models\Logic\Brands)->brands();

        $categoryLists = $vehicletypes;

        return view('AdminArea.EditVehicle', [
             'vehicles' => $vehicles, 'vehicletypes' => $vehicletypes, 'vehiclebrands' => $vehiclebrands, 'categoryLists' => $categoryLists,
        ]);
    }

    /**
     * Post edited form data to database table.
     * @returnPathn \Illuminate\Contracts\Support\Renderable
     */
    public function editCarFormPost(EleganceFormRequest $request, $id)
    {
        $data = array(
            //Sanitize inputs befor saving to database
            'deleted'      => 0,
            'blocked'      => 0,
            'sold'         => 0,
            'vehicletypes_id'  => filter_var($request->input('VehicleType'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'vehiclebrands_id' => filter_var($request->input('Brand'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'model'            => filter_var($request->input('Model'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),

            'title'            => filter_var($request->input('Title'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'description'      => filter_var($request->input('Description'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'transmission'     => filter_var($request->input('Transmission'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'manufacture_date' => filter_var($request->input('ManufactureDate'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'maintenance_history' => filter_var($request->input('MaintenanceHistory'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'used'             => filter_var($request->input('UsedOrNew'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'price'            => filter_var($request->input('Price'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),

            'condition'        => filter_var($request->input('Condition'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'mileage'          => filter_var($request->input('Mileage'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'customizations'   => filter_var($request->input('Customizations'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'modifications'    => filter_var($request->input('Modifications'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'engine_change'    => filter_var($request->input('EngineChange'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'exterior_finish'  => filter_var($request->input('ExteriorFinish'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'exterior_colour'  => filter_var($request->input('ExteriorColour'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'interior_finish'  => filter_var($request->input('InteriorFinish'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'roof'             => filter_var($request->input('Roof'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'accessories'      => filter_var($request->input('Accessories'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'tags'             => filter_var($request->input('Tags'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'created_at'       => now(),
            'updated_at'       => now(),
            'view_count'       => 0,
            'integer_flag1'    => 0,
            'integer_flag2'    => 0,
            'integer_flag3'    => 0,
            'string_flag1'     => "",
            'string_flag2'     => "",
            'string_flag3'     => "",
        );

        Vehiclefulldata::where('id', $id)
            ->update($data);

        session()->flash('infoStatus', 'Good Job! The post has been changed, successfully.');

        //Redirect to a routes name
        return redirect()->route('postView', [ $id, ]);
    }

    /**
     * Show the application image edit form.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editCarImageForm($ImageId)
    {
        /*  List of vehicle types begins here */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        /* Get image's full data */
        $image = (new \App\Models\Logic\Images)->image($ImageId);

        return view('AdminArea.EditVehicleImage', ['ImageId' => $ImageId, 'image' => $image, 'categoryLists' => $categoryLists,]);
    }

    /**
     * Process photo image change upload data
     */
    public function editCarImageFormPost(EleganceImageFormEditRequest $request, $ImageId)
    {
        /* Create new file name */
        $newImage = $request->file('file');
        $hashedName = hash('ripemd160', time()).'.'.$newImage->getClientOriginalExtension();

        /* Get previous image's full data */
        $image = (new \App\Models\Logic\Images)->image($ImageId);

        /* Delete previous image file from images directory. Set the path to the files directory, including the previous filename */
        $pathToFile = public_path('VehiclesInStock/images/' . $image->disk_image_filename);

        /* Delete the file using Laravel's file handling method for deleting files */
        File::delete($pathToFile);

        /* Set image directory path & save the uploaded file to the directory */
        $destinationPath = public_path('/VehiclesInStock/images/');
        $newImage->move($destinationPath, $hashedName);

        /* Update the image entry in database with current upload data */
        $data = array(
            //Sanitize inputs before saving to database
            'caption' => filter_var($request->input('Caption'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'disk_image_filename' => $hashedName,//filter_var($hashedName, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            'updated_at' => now(),
        );

        Vehiclefulldataimage::where('id', $ImageId)
            ->update($data);

        //This is the message to display        
        session()->flash('infoStatus', 'Good Job! The car photo has been changed, successfully.');

        //Redirect to a routes name
        return redirect()->route('postView', [ $image->vehiclefulldatas_id, ]);
    }

    /**
     * Delete a vehicle photo
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function imageDelete($ImageId, $PostId)
    {
        /*  Get a vehicle's photo filename from the database */
        $imageFilename = (new \App\Models\Logic\Images)->imagefilename($ImageId);

        /* Set the path to the files directory, include the file name */
        $pathToFile = public_path('VehiclesInStock/images/' . $imageFilename);

        /* Delete the file using Laravel's file handling method for deleting files */
        File::delete($pathToFile);

        /*  Delete a vehicle's photo entry in the database */
        $vehicles = (new \App\Models\Logic\Images)->deleteSingleImage($ImageId);

        /* Set a response message */
        session()->flash('infoStatus', 'Good Job! The photo has been deleted, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('postView', [$PostId,]);
    }

    /**
     * Delete a vehicle photo (different route)
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function imageDelete2($ImageId, $PostId)
    {
        /*  Get a vehicle's photo filename from the database */
        $imageFilename = (new \App\Models\Logic\Images)->imagefilename2($ImageId);

        /* Set the path to the files directory, include the file name */
        $pathToFile = public_path('VehiclesInStock/images/' . $imageFilename->disk_image_filename);

        /* Delete the file using Laravel's file handling method for deleting files */
        File::delete($pathToFile);

        /*  Delete a vehicle's photo entry in the database */
        $vehicles = (new \App\Models\Logic\Images)->deleteSingleImage($ImageId);

        /* Set a response message */
        session()->flash('infoStatus', 'Good Job! The photo has been deleted, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('postView', [$PostId,]);
    }

    /**
     * Show all sold cars.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function solds()
    {
        /*  List of sold vehicles posted here */
        $vehicles = (new \App\Models\Logic\Posts)->postsSold(25);

        /* Get list of categories */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        //Blade view file
        return view('AdminArea.SoldVehicles', [
            'vehicles' => $vehicles, 'categoryLists' => $categoryLists
        ]);
    }

    /**
     * Show all used cars.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function usedCars()
    {
        /*  List of used vehicles posted here */
        $vehicles = (new \App\Models\Logic\Posts)->postsUsed(25);

        /* Get list of categories */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        //Blade view file
        return view('AdminArea.UsedVehicles', [
            'vehicles' => $vehicles, 'categoryLists' => $categoryLists
        ]);
    }

    /**
     * Show all new cars.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newCars()
    {
        /*  List of new vehicles posted here */
        $vehicles = (new \App\Models\Logic\Posts)->postsNew(25);

        /* Get list of categories */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        //Blade view file
        return view('AdminArea.NewVehicles', [
            'vehicles' => $vehicles, 'categoryLists' => $categoryLists,
        ]);
    }

    /**
     * Show all cars for a category name.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categoryList2( $categoryName )
    {
        /* Get category ID using given name */
        $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);

        /* Get list of cars, all having the same category ID */
        $vehicles = (new \App\Models\Logic\Posts)->categoryPosts(25, $categoryID);

        /* Get list of categories */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        //Blade view file
        return view('AdminArea.Categories', [
            'categoryName' => $categoryName, 'vehicles' => $vehicles, 'categoryLists' => $categoryLists, 
        ]);
    }

    /**
     * Show all cars for a category name.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categoryList( $categoryName )
    {
        /* Get category ID using given name */
        if($categoryName == 'Armoured')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        elseif($categoryName == 'Coupé')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        elseif($categoryName == 'Van')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        elseif($categoryName == 'Hatchback')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        elseif($categoryName == 'Off-roader')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        elseif($categoryName == 'Pickup')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        elseif($categoryName == 'Saloon')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        elseif($categoryName == 'Sports')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        elseif($categoryName == 'SUV')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        elseif($categoryName == 'Truck')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        elseif($categoryName == 'Wagon')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        elseif($categoryName == 'Others')
        {
            /* Get category ID using given name */
            $categoryID = (new \App\Models\Logic\Types)->typeId($categoryName);
        }
        else {
            /* Redirect to a route's name because there isn't a Category name as provided */
            return redirect()->route($AdminIndex);
        }

        /* Get list of cars, all having the same category ID */
        $vehicles = (new \App\Models\Logic\Posts)->categoryPosts(25, $categoryID);

        /* Get list of categories */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        //Blade view file
        return view('AdminArea.Categories', [
            'categoryName' => $categoryName, 'vehicles' => $vehicles, 'categoryLists' => $categoryLists, 
        ]);
    }

    /**
     * Show a post view.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewPost($id)
    {
        /*  Vehicles full data here */
        $vehicle = (new \App\Models\Logic\Posts)->post($id);

        if ( !count($vehicle) > 0 )
        {
            session()->flash('infoStatus', 'Nice try! The vehicle you want to see doesn\' exist. Try not to break this website.');

            /* Redirect to the dashboard because there's no post with said ID*/
            return redirect()->route('home');
        }
        else {
            $vehicles = $vehicle;   
        }

        /* Get list of categories */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        //Blade view file
        return view('AdminArea.VehicleView', [
            'post_id' => $id, 'vehicles' => $vehicles, 'categoryLists' => $categoryLists,
        ]);
    }

    /**
     * Mark a vehicle as sold and redirect to all posts list.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postSold($id, $returnPath)
    {
        /* Mark a vehicle as sold */
        (new \App\Models\Logic\Posts)->postMarkAsSold($id);

        session()->flash('infoStatus', 'Good Job! The car has been marked as sold, successfully.');
        
        //Redirect to a routes name
        return redirect()->route($returnPath);
    }

    /**
     * Mark a vehicle as sold and redirect to post view
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postSold2($id)
    {
        /* Mark a vehicle as sold */
        (new \App\Models\Logic\Posts)->postMarkAsSold($id);

        session()->flash('infoStatus', 'Good Job! The car has been marked as sold, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('postView', [$id]);
    }

    /**
     * Delete a vehicle as well as any associated photo
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postDelete($id, $returnPath)
    {
        /*  Delete a vehicle as well as any associated photo */
        $vehicles = (new \App\Models\Logic\Posts)->postDelete($id);

        session()->flash('infoStatus', 'Good Job! The car and any associated photo have been deleted, successfully.');
        
        //Redirect to a routes name
        return redirect()->route($returnPath);
    }

    /**
     * Mark a vehicle in Category list as sold
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postSoldForCategories($id, $categoryName)
    {
        /* Mark a vehicle in Category list as sold */
        (new \App\Models\Logic\Posts)->postMarkAsSold($id);

        session()->flash('infoStatus', 'Good Job! The car has been marked as sold, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('categoryList', [$categoryName,]);
    }

    /**
     * Mark a vehicle in Category list as deleted as well as any associated photo
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postDeleteForCategories($id, $categoryName)
    {
        /* Mark a vehicle in Category list as deleted as well as any associated photo */
        $vehicles = (new \App\Models\Logic\Posts)->postDelete($id);

        session()->flash('infoStatus', 'Good Job! The car and any associated photo have been deleted, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('categoryList', [$categoryName,]);
    }

    /**
     * Show all car images.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function images()
    {
        /*  List of vehicles' images here */
        $vehicles = (new \App\Models\Logic\Images)->imagesList();

        /* Get list of categories */
//        $categoryLists = (new \App\Models\Logic\Types)->types();

        //Blade view file
        return view('AdminArea.Images', [
            'vehicles' => $vehicles, /*'categoryLists' => $categoryLists,*/
        ]);
    }

    /**
     * Show all cars.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function posts()
    {
        /*  List of vehicles posted here */
        $vehicles = (new \App\Models\Logic\Posts)->posts(25);

        /*  List of vehicle types begins here */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        //Blade view file
        return view('AdminArea.Vehicles', [
            'vehicles' => $vehicles, 'categoryLists' => $categoryLists, 
        ]);
    }
}
