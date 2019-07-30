<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BloodData;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userdata = Auth::user();
        return view('profile', compact('userdata'));
    }   
    
    public function addBloodDetail(Request $request, BloodData $bloodData){
        if ($request->isMethod('post')) {
            $attribute = $request->validate([
                'mobile_no' => 'required|min:10',
                'blood_group' => 'required',
                'state' => 'required |min:2',
                'city' => 'required |min:2',
                'name' => '',
            ]);

            $attribute['name'] = Auth::user()->name;
            $attribute['user_id'] = Auth::user()->id;
            // dd($attribute);
            $bloodData->create($attribute);
            return redirect('profile');
        }elseif ($request->isMethod('get')) {
            $userdata = Auth::user();
            return view('profileEdit', compact('userdata'));
        }
    }
}
