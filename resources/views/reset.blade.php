@extends('adminlte::page')

@section('title', 'Rakta | reset password')

@section('content_header')
    <h1>Change Password</h1>
@stop

@section('content')

    <div class="card card-primary">
        <div class="card-header text-light bg-primary"> Change Password</div>
        <div class="card-body">
           <div class="container">
               <form method="POST" action="/password/change">
                   @csrf
                   @if($errors->any())
                <ul class="alert alert-danger" style="list-style:none;">
                    @foreach($errors->all() as $error=>$err)
                    <li style="color:#fff;"> {{$err}} </li>
                    @endforeach
                </ul>
                @endif
                   <div class="form-group row">
                       <label for="current_password" class="col-md-2">Current Password</label>
                       <div class="col-sm-5">
                           <input type="password" required class="form-control" name="current_password" id="current_password" placeholder="Enter Current Password...">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="password" class="col-md-2">New Password</label>
                       <div class="col-sm-5">
                           <input type="password" required class="form-control" name="password" id="password" placeholder="Choose New Password...">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="password_confirmation" class="col-md-2">Confirm New Password</label>
                       <div class="col-sm-5">
                           <input type="password" required class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm New Password...">
                       </div>
                   </div>
                   <div class="col-md-7">
                       <button type="submit" class="btn btn-primary float-right">Change Password</button>
                   </div>
               </form>
           </div>
        </div>
    </div>
@stop