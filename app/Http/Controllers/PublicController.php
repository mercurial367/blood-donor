<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\BloodData;
use App\StateCity;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
    public function index()
    {
        $states = StateCity::all()->pluck('state')->unique();
        $cities = StateCity::all()->pluck('city')->unique();
        return view('publicHome', compact('states', 'cities'));
    }

    public function getAllCityStates()
    {
        $states = StateCity::all()->pluck('state')->unique();
        $cities = StateCity::all()->pluck('city')->unique();
        return ['states'=> $states, 'cities'=> $cities];
    }

    public function CityonStateSelect(Request $request)
    {
       $city = StateCity::where('state', '=', $request->input('state'))->pluck('city')->unique();
       return $city;
    }
    public function StateonCitySelect(Request $request)
    {
        $state = StateCity::where('city', '=', $request->input('city'))->pluck('state')->unique();
        return $state;
    }

    public function searchDonorsData(Request $request, BloodData $bloodData)
    {
        $bloodGroup = $request->input('blood_group');
        $state = $request->input('state');
        $city = $request->input('city');
        $name = $request->input('name');
        $donors = $bloodData->all()->filter(function($allDonors) use($bloodGroup, $name, $city,$state){
            if(isset($bloodGroup)){
                if(isset($city)){
                    if(isset($name)){
                        if(Str::lower($allDonors['blood_group']) === Str::lower($bloodGroup) and Str::contains(Str::lower($allDonors['city']), Str::lower($city)) and Str::contains(Str::lower($allDonors['name']), Str::lower($name)) and Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                            return $allDonors;
                        }
                    }else{
                        if(Str::lower($allDonors['blood_group']) === Str::lower($bloodGroup) and Str::contains(Str::lower($allDonors['city']), Str::lower($city)) and Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                            return $allDonors;
                        }
                    }

                }else{
                    if(isset($state)){
                        if(isset($name)){
                            if(Str::lower($allDonors['blood_group']) === Str::lower($bloodGroup) and Str::contains(Str::lower($allDonors['name']), Str::lower($name)) and Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                                return $allDonors;
                            }
                        }else{
                            if(Str::lower($allDonors['blood_group']) === Str::lower($bloodGroup) and Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                                return $allDonors;
                            }
                        }
                    }
                    else{
                        if(isset($name)){
                            if(Str::lower($allDonors['blood_group']) === Str::lower($bloodGroup) and Str::contains(Str::lower($allDonors['name']), Str::lower($name))){
                                return $allDonors;
                            }
                        }else{
                            if(Str::lower($allDonors['blood_group']) === Str::lower($bloodGroup)){
                                return $allDonors;
                            }
                        }
                    }
                }
            }else{
                if(isset($city)){
                    if(isset($name)){
                        if(Str::contains(Str::lower($allDonors['city']), Str::lower($city)) and Str::contains(Str::lower($allDonors['name']), Str::lower($name)) and Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                            return $allDonors;
                        }
                    }else{
                        if(Str::contains(Str::lower($allDonors['city']), Str::lower($city)) and Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                            return $allDonors;
                        }
                    }

                }else{
                    if(isset($state)){
                        if(isset($name)){
                            if(Str::contains(Str::lower($allDonors['name']), Str::lower($name)) and Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                                return $allDonors;
                            }
                        }else{
                            if(Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                                return $allDonors;
                            }
                        }
                    }else{
                        if(isset($name)){
                            if(Str::contains(Str::lower($allDonors['name']), Str::lower($name))){
                                return $allDonors;
                            }
                        }else{
                            return $allDonors;
                        }
                    }
                }
            }

        })->paginate(10) ;
        
        if(Auth::user()){
            return view('searchData', compact('donors','city', 'bloodGroup', 'name', 'state'));
        }else{
            return view('publicSearchData', compact('donors','city', 'bloodGroup', 'name', 'state'));
        }
    }
}
