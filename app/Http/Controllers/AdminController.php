<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\BloodData;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::with('bloodData')->get()->filter(function($allUsers){
            if($allUsers->role != 1){
                return $allUsers;
            }
        })->paginate(10);
        $self = Auth::user();
        // dd($users);
        return view('viewAllUser',compact('users', 'self'));
    }
    public function statusChange($id)
    {
        $user = User::find($id);
        if((string)$user->active == 0){
            $user->update(["active" => true]);
        }
        else{
            $user->update(["active" => false]);  
        }
        return redirect('/admin/view-users');
        return (string)$user->active;
    }
    public function addDonors()
    {
        return view('addDonors');
    }
    public function addDonorsData(Request $request, BloodData $bloodData)
    {
        $attribute = $request->validate([
            'mobile_no' => 'required|min:10|unique:blood_data',
            'blood_group' => 'required',
            'state' => 'required |min:2',
            'city' => 'required |min:2',
            'name' => 'required |min:2',
        ]);
        $bloodData->create($attribute);
        Session::flash('success','Data has successfully saved.');
        return redirect('/admin/add-donor');
    }

    public function downloadCsvFile()
    {
        $file= public_path(). "/download/bloodData.csv";

    $headers = array(
              'Content-Type: application/csv',
            );

    return Response::download($file, 'bloodData.csv', $headers);
    }
    public function addDonorsDataFromCSV(Request $request){
        // if ($request->input('file') != null ){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            $valid_extension = array("csv");
            if(in_array(strtolower($extension),$valid_extension)){
                $location =  public_path().'/uploads';

                // Upload file
                $file->move($location,$filename);

                // Import CSV to Database
                $filepath = $location."/".$filename;

                $file = fopen($filepath,"r");

                $importData_arr = array();
                $i = 0;
                
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata );
                    
                    // Skip first row 
                    if($i == 0){
                       $i++;
                       continue; 
                    }
                    for ($c=0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata [$c];
                     }
                     $i++;
                }
                fclose($file);

                foreach($importData_arr as $importData){

                    $insertData = array(
                       "name"=>$importData[0],
                       "blood_group"=>$importData[1],
                       "mobile_no"=>$importData[2],
                       "city"=>$importData[3],
                       "state"=>$importData[4]
                    );
                    BloodData::create($insertData);
        
                  }
                  Session::flash('success-msg','Import Successful.');
                  
            }
            else{
                Session::flash('error-msg','Invalid File Extension.');
             }
       
            return redirect('/admin/add-donor');
        // }else{
        //     return redirect('/');
        // }
    }
}
