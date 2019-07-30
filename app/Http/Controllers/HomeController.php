<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BloodData;
use App\StateCity;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $bloodData
        $userdata = Auth::user();
        $states = StateCity::all()->pluck('state')->unique();
        $cities = StateCity::all()->pluck('city')->unique();
        return view('home', compact('userdata', 'states', 'cities'));
    }
}
