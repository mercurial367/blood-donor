<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BloodData;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
                        if(Str::contains(Str::lower($allDonors['blood_group']), Str::lower($bloodGroup)) and Str::contains(Str::lower($allDonors['city']), Str::lower($city)) and Str::contains(Str::lower($allDonors['name']), Str::lower($name)) and Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                            return $allDonors;
                        }
                    }else{
                        if(Str::contains(Str::lower($allDonors['blood_group']), Str::lower($bloodGroup)) and Str::contains(Str::lower($allDonors['city']), Str::lower($city)) and Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                            return $allDonors;
                        }
                    }

                }else{
                    if(isset($state)){
                        if(isset($name)){
                            if(Str::contains(Str::lower($allDonors['blood_group']), Str::lower($bloodGroup)) and Str::contains(Str::lower($allDonors['name']), Str::lower($name)) and Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                                return $allDonors;
                            }
                        }else{
                            if(Str::contains(Str::lower($allDonors['blood_group']), Str::lower($bloodGroup)) and Str::contains(Str::lower($allDonors['state']), Str::lower($state))){
                                return $allDonors;
                            }
                        }
                    }
                    else{
                        if(isset($name)){
                            if(Str::contains(Str::lower($allDonors['blood_group']), Str::lower($bloodGroup)) and Str::contains(Str::lower($allDonors['name']), Str::lower($name))){
                                return $allDonors;
                            }
                        }else{
                            if(Str::contains(Str::lower($allDonors['blood_group']), Str::lower($bloodGroup))){
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
        
        
        return view('searchData', compact('donors','city', 'bloodGroup', 'name', 'state'));
    }
}
