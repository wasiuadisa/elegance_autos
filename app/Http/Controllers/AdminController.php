<?php

namespace App\Http\Controllers;

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

class AdminController extends Controller
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
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*  List of vehicle types begins here */
        $vehicletypes = (new \App\Models\Logic\Types)->types();

        /*  List of vehicle brands begins here */
        $vehiclebrands = (new \App\Models\Logic\Brands)->brands();

        return view('Dashboard', [
            'vehicletypes' => $vehicletypes, 'vehiclebrands' => $vehiclebrands,
        ]);
    }

    /**
     * Show the test page.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function template()
    {
        return view('AdminArea.Template');
    }

    /**
     * Show the test page.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function test()
    {
        /*  List of vehicle types begins here */
        $vehicletypes = (new \App\Models\Logic\Types)->types();
        
        /*  List of vehicle brands begins here */
        $vehiclebrands = (new \App\Models\Logic\Brands)->brands();

        $categoryLists = $vehicletypes;

        return view('AdminArea.Testing', [
            'vehicletypes' => $vehicletypes, 'vehiclebrands' => $vehiclebrands, 'categoryLists' => $categoryLists,
        ]);
    }

    /**
     * Show all car categories.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categories()
    {
        /*  List of vehicles categories here */
        $vehicles = (new \App\Models\Logic\Categories)->categories(25);

        /*  List of vehicle types begins here */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        //Blade view file
        return view('AdminArea.Categories2', [
            'vehicles' => $vehicles, 'categoryLists' => $categoryLists, 
        ]);
    }
}
