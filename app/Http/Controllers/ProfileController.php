<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BloodData;
use App\StateCity;
use App\User;
use Illuminate\Support\Facades\Session;
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
    
    public function changePassword(Request $request)
    {
        $attribute = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'current_password' => ['required', 'string', 'min:8'],
        ]);
        if(Hash::check($attribute['current_password'], Auth::user()->password)){
            User::find(Auth::user()->id)->update(['password'=> Hash::make($attribute['password'])]);
            Session::flash('pass-change-success-msg','Password Successfully Changed, Please login with New Password');
            Auth::logout();
            return redirect('login');
        }else{
            $errors = 'Current Password is wrong, Please enter valid one';
            return redirect()->back()->withErrors($errors);
        }
    }

    public function addBloodDetail(Request $request, BloodData $bloodData){
        if ($request->isMethod('post')) {
            $attribute = $request->validate([
                'mobile_no' => 'required|min:10',
                'blood_group' => 'required',
                'state' => 'required |min:2',
                'city' => 'required |min:2',
                'name' => 'required | min:2',
            ]);
            $attribute1 = $request->validate([
                'name' => 'required | min:2',
            ]);   
            $id = Auth::user()->id;
            User::find($id)->update($attribute1);  
            BloodData::where('user_id','=', $id)->update($attribute);  
            return redirect('profile');
        }elseif ($request->isMethod('get')) {
            $userdata = Auth::user();
            $bloodData = BloodData::where('user_id', '=', $userdata->id)->get();
            // dd($bloodData);
            $states = StateCity::all()->pluck('state')->unique();
            $cities = StateCity::where('state', '=', $bloodData[0]->state)->get()->pluck('city')->unique();
            return view('profileEdit', compact('userdata','bloodData', 'states', 'cities'));
        }
    }
}
