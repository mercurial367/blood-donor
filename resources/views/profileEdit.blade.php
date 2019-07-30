@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Edit Profile</h1>
@stop

@section('content')
@if ($userdata->bloodData)
<div class="card card-primary">
    <div class="card-header bg-primary">{{$userdata->name}}'s Profile</div>
    <div class="card-body text-center">
        <h3>Your profile is up to date</h3>
        <a href="profile">go back to your profile</a>
    </div>
</div>
@elseif ($userdata)
<div class="card card-primary">
    <div class="card-header bg-primary">Editing {{$userdata->name}}'s Profile</div>
        <div class="card-body">
            <div class="container">
            <form method="POST" action="/profile/edit">
                @csrf
                @if($errors->any())
                    <ul class="alert alert-danger" style="list-style:none;">
                        @foreach($errors->all() as $error=>$err)
                           <li style="color:#000;"> {{$err}} </li>
                        @endforeach
                    </ul>
                @endif
                    <div class="form-group row">
                        <label for="name" class="col-sm-1 col-form-label">Name</label>
                        <div class="col-sm-5">
                        <input type="text" disabled class="form-control" name="name" id="name" value="{{$userdata->name}}">
                        </div>
                        <label for="email" class="col-sm-1 col-form-label">Email</label>
                        <div class="col-sm-5">
                        <input type="text" disabled class="form-control" name="email" id="email" value="{{$userdata->email}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile_no" class="col-sm-1 col-form-label">Mobile Number</label>
                        <div class="col-sm-5">
                        <input type="number" required class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter your mobile number">
                        </div>
                        <label for="blood_group" class="col-sm-1 col-form-label">Blood Group</label>
                        <div class="col-sm-5">
                        <select required type="text" class="form-control" name="blood_group" id="blood_group">
                            <option value="" selected hidden>Select your blood group here</option>
                            <option value="A+">A+</option>
                            <option value="B+">B+</option>
                            <option value="AB+">AB+</option>
                            <option value="O+">O+</option>
                            <option value="A-">A-</option>
                            <option value="B-">B-</option>
                            <option value="AB-">AB-</option>
                            <option value="O-">O-</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="state" class="col-sm-1 col-form-label">State</label>
                        <div class="col-sm-5">
                            <input type="text" required class="form-control" name="state" id="state" placeholder="Enter your State here">
                        </div>
                        <label for="city" class="col-sm-1 col-form-label">City</label>
                        <div class="col-sm-5">
                            <input type="text" required class="form-control" name="city" id="city" placeholder="Enter your City here">
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <input name="update_btn" id="update_btn" class="btn btn-primary" type="submit" value="Update">
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
</div>  
@else
<div class="text-center">
    <h2>somthing went wrong </h2>    
</div>        
@endif    
@stop