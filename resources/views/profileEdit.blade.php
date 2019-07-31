@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Edit Profile</h1>
@stop

@section('content')

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
                        <input type="text" class="form-control" name="name" id="name" value="{{$userdata->name}}">
                        </div>
                        <label for="email" class="col-sm-1 col-form-label">Email</label>
                        <div class="col-sm-5">
                        <input type="text" disabled class="form-control" name="email" id="email" value="{{$userdata->email}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile_no" class="col-sm-1 col-form-label">Mobile Number</label>
                        <div class="col-sm-5">
                        <input type="number" required class="form-control" value="{{$bloodData[0]->mobile_no}}" name="mobile_no" id="mobile_no" placeholder="Enter your mobile number">
                        </div>
                        <label for="blood_group" class="col-sm-1 col-form-label">Blood Group</label>
                        <div class="col-sm-5">
                        <select required type="text" class="form-control" name="blood_group" id="blood_group">
                            <option value="" selected hidden>Select your blood group here</option>
                            <option {{$bloodData[0]->blood_group == 'A+'? 'selected':''}} value="A+">A+</option>
                            <option {{$bloodData[0]->blood_group == 'B+'? 'selected':''}}  value="B+">B+</option>
                            <option {{$bloodData[0]->blood_group == 'AB+'? 'selected':''}}  value="AB+">AB+</option>
                            <option {{$bloodData[0]->blood_group == 'O+'? 'selected':''}}  value="O+">O+</option>
                            <option {{$bloodData[0]->blood_group == 'A-'? 'selected':''}}  value="A-">A-</option>
                            <option {{$bloodData[0]->blood_group == 'B-'? 'selected':''}}  value="B-">B-</option>
                            <option {{$bloodData[0]->blood_group == 'AB-'? 'selected':''}}  value="AB-">AB-</option>
                            <option {{$bloodData[0]->blood_group == 'O-'? 'selected':''}}  value="O-">O-</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="state" class="col-sm-1 col-form-label">State</label>
                        <div class="col-sm-5">
                                <select type="text" class="form-control" name="state" id="state">
                                        @foreach($states as $state)
                                            @if ($state != $bloodData[0]->state)
                                            <option value="{{$state}}">{{$state}}</option>
                                            @else
                                            <option selected value="{{$state}}">{{$state}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                        </div>
                        <label for="city" class="col-sm-1 col-form-label">City</label>
                        <div class="col-sm-5">
                                <select class="form-control" name="city" id="city">
                                        @foreach($cities as $city)
                                            @if ($city != $bloodData[0]->city)
                                                <option value="{{$city}}">{{$city}}</option>
                                            @else
                                                <option selected value="{{$city}}">{{$city}}</option>
                                            @endif
                                        @endforeach
                                    </select>
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
  <script>
  $('#state').on('change', function() {
        $('#city').empty();
        $('#city').html('<option selected value="">Loading...</option>');
        $.post("{{ url('get-city')}}", 
				{ state: $(this).val(), _token: '{{csrf_token()}}' }, 
				function(data) {
					var city = $('#city');
					city.empty();
                    $('#city').html('<option hidden selected value="">City</option>');
                    $.each(data, function(element) {
			            city.append("<option value='"+ data[element] +"'>" + data[element] + "</option>");
			        });
                });
    });
  </script> 
@stop