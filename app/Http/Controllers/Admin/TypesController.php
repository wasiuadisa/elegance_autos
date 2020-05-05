<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/** Added this for database Facade support
      as directed by 5.7 documentation
**/
use Illuminate\Support\Facades\DB;

//Import database models
use App\Models\Databases\Vehicletype;

class TypesController extends Controller
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
     * Show all car types.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function types()
    {
        /*  List of vehicles genres/types here */
        $vehicles = (new \App\Models\Logic\Types)->carTypes(25);

        /*  List of vehicle types begins here */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        //Blade view file
        return view('AdminArea.Types', [
            'vehicles' => $vehicles, 'categoryLists' => $categoryLists, 
        ]);
    }

    /**
     * Show the new vehicle type form
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newCarTypeForm()
    {
        /*  List of vehicles genres/types here */
        $vehicles = (new \App\Models\Logic\Types)->carTypes(25);

        /*  List of vehicle types begins here */
        $categoryLists = (new \App\Models\Logic\Types)->types();

        return view('AdminArea.NewType', [
            'vehicles' => $vehicles, 'categoryLists' => $categoryLists,
        ]);
    }

    /**
     * Post the new type name.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newCarTypeFormPost(Request $request)
    {
        $this->validate($request, [
            //This form data go in the type's table
            'type'   => 'required|string|between:1,150',
        ]);

        //Instanstiate Autobarnpost input class model
        $newtypes              = new Vehicletype;

        //Sanitize inputs
        $newtypes->name        = filter_var($request->input('type'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
        $newtypes->created_at  = now();
        $newtypes->updated_at  = now();
        $newtypes->save();

        session()->flash('infoStatus', 'Good Job! The new type has been created, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('types');
    }

    /**
     * Show form for editing vehicle type name
     * @return \Illuminate\Contracts\Support\Renderable
     */ 
    public function editCarTypeForm($id){

        /*  List of vehicles genres/types here */
        $vehicles = (new \App\Models\Logic\Types)->carTypes(25);

        /*  List of vehicle types begins here */
        $categoryLists = (new \App\Models\Logic\Types)->types();
        
        $types  =   Vehicletype::findOrFail($id);

        return view('AdminArea.EditType', [
            'types' => $types, 'vehicles' => $vehicles, 'categoryLists' => $categoryLists,
        ]);
    }

    /**
     * Update database, using provided ID for editing vehicle type name
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editCarTypeFormPost(Request $request, $id){
        $this->validate($request, [
            //This form data replaces the one in type's table
            'type'   => 'required|string|between:1,150',
        ]);

        $data = array(
            //Encode the inputs
            'name' => filter_var($request->input('type'),  FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW),
            'updated_at' => now(),
        );

        Vehicletype::where('id', $id)
            ->update($data);

        session()->flash('infoStatus', 'Good Job! The type name has been changed, successfully.');

        //Redirect to a routes name
        return redirect()->route('types');
    }

    /**
     * Delete a vehicle type/genres
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function typeDelete($id)
    {
        /*  Delete a vehicle type/genres */
        $vehicles = (new \App\Models\Logic\Types)->typeDelete($id);

        session()->flash('infoStatus', 'Good Job! The vehicle type has been deleted, successfully.');
        
        //Redirect to a routes name
        return redirect()->route('types');
    }
}
