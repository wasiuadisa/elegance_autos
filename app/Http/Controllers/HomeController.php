<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('privilegeContributor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*  List of vehicle types begins here */
        $vehicletypes = (new \App\Models\Logic\Types)->types();

        /*  List of vehicle brands begins here */
        $vehiclebrands = (new \App\Models\Logic\Brands)->brands();

        $dashboardLink = "";

        return view('home', [
            'vehicletypes' => $vehicletypes, 'vehiclebrands' => $vehiclebrands,
        ])->with($dashboardLink, ' class="active"');
    }
}
