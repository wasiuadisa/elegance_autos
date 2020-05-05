<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/** Added this for database Facade support
      as directed by 5.7 documentation
**/
use Illuminate\Support\Facades\DB;

//Import database models
use App\Models\Databases\Vehiclebrand;

class BrandsController extends Controller
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
     * Show all car brands.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function brands()
    {
        /*  List of vehicles brands here */
        $vehicles = (new \App\Models\Logic\Brands)->carBrands(25);

        /*  List of vehicle types begins here */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        //Blade view file
        return view('AdminArea.Brands', [
            'vehicles' => $vehicles, 'categoryLists' => $categoryLists, 
        ]);
    }

    /**
     * Show the new vehicle brands form
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newCarBrandForm()
    {
        /*  List of vehicles brands here */
        $vehicles = (new \App\Models\Logic\Brands)->carBrands(25);

        /*  List of vehicle brands begins here */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        return view('AdminArea.NewBrand', [
            'vehicles' => $vehicles, 'categoryLists' => $categoryLists,
        ]);
    }

    /**
     * Post the new brand name.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newCarBrandFormPost(Request $request)
    {
        $this->validate($request, [
            //This form data go in the type's table
            'brand'   => 'required|string|between:1,150',
        ]);

        //Instanstiate Vehiclebrand input class model
        $newbrands              = new Vehiclebrand;

        //Sanitize inputs
        $newbrands->name        = filter_var($request->input('brand'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
        $newbrands->created_at  = now();
        $newbrands->updated_at  = now();
        $newbrands->save();

        session()->flash('infoStatus', 'Good Job! The new brand has been created, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('brands');
    }

    /**
     * Show form for editing vehicle brand name
     * @return \Illuminate\Contracts\Support\Renderable
     */ 
    public function editCarBrandForm($id){

        /*  List of vehicles brands here */
        $vehicles = (new \App\Models\Logic\Brands)->carBrands(25);

        /*  List of vehicle brands begins here */
        $categoryLists = (new \App\Models\Logic\Types)->types();
        
        $brands  =   Vehiclebrand::findOrFail($id);

        return view('AdminArea.EditBrand', [
            'brands' => $brands, 'vehicles' => $vehicles, 'categoryLists' => $categoryLists,
        ]);
    }

    /**
     * Update database, using provided ID for editing vehicle brand name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editCarBrandFormPost(Request $request, $id){
        $this->validate($request, [
            //This form data replaces the one in brand's table
            'brand'   => 'required|string|between:1,150',
        ]);

        $data = array(
            //Encode the inputs
            'name' => filter_var($request->input('brand'),  FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW),
            'updated_at' => now(),
        );

        Vehiclebrand::where('id', $id)
            ->update($data);

        session()->flash('infoStatus', 'Good Job! The brand name has been changed, successfully.');

        //Redirect to a routes name
        return redirect()->route('brands');
    }

    /**
     * Delete a vehicle brands
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function brandDelete($id)
    {
        /*  Delete a vehicle brands */
        $vehicles = (new \App\Models\Logic\Brands)->brandDelete($id);

        session()->flash('infoStatus', 'Good Job! The vehicle brand has been deleted, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('brands');
    }
}