@extends('adminlte::page')

@section('title', 'Rakta | Profile')

@section('content_header')
    <h1>Profile</h1>
@stop

@section('content')
    @if ($userdata)
    <div class="card card-primary">
            <div class="card-header bg-primary"> {{$userdata->name}}'s Profile</div>
        <div class="card-body">
            <div class="text-center">
                <h3> Personal Details</h3>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    Full Name : {{$userdata->name}}
                </div>
                <div class="col-sm-6">
                    Email Address: {{$userdata->email}}
                </div>
            
            
                @if ($userdata->role)
                <div class="col-sm-6">
                        User-Type : Admin
                    </div>
                @endif
                @if ($userdata->bloodData)
                <div class="col-sm-6">
                        Mobile Number : {{$userdata->bloodData->mobile_no}}
                    </div>
                    <div class="col-sm-6">
                        Blood Group : {{$userdata->bloodData->blood_group}}
                    </div>
                    <div class="col-sm-6">
                        City : {{$userdata->bloodData->city}}
                    </div>
                    <div class="col-sm-6">
                        State : {{$userdata->bloodData->state}}
                    </div>
                @else
                <div class="col-sm-12 text-center">
                <form action="/profile/edit" method="GET">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
                @endif
                
            </div>
        </div>
    </div>  
    @else
    <div class="text-center">
        <h2>somthing went wrong </h2>    
    </div>        
    @endif    
@stop