@extends('welcome')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('publicFunctions')

<div class="card mt-4">
    <div class="card-header bg-primary text-light"> <b> Search Donors </b></div>
    <div class="card-body pb-0">
        <div class="container">
            <form method="GET" action="/public/blood-donors">
                @csrf

                <div class="form-group row">
                    <div class="col-md-3 row mt-1 mb-1">
                        {{-- <label for="blood_group" class="col-md-4 col-form-label " style="padding : 0; margin:0;">Blood
                            Group</label> --}}
                        <div class="col-md-12">
                            <select type="text" class="form-control" name="blood_group" id="blood_group">
                                <option value="" selected hidden>Blood group</option>
                                <option value="">All</option>
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
                    <div class="col-md-3 row mt-1 mb-1">
                        {{-- <label for="state" class="col-md-4 col-form-label " style="padding : 0; margin:0;">State </label> --}}
                        <div class="col-md-12">
                            <select type="text" class="form-control" name="state" id="state">
                                <option value="" selected hidden>State</option>
                                @foreach($states as $state)
                                    <option value="{{$state}}">{{$state}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 row mt-1 mb-1">
                        {{-- <label for="city" class="col-md-4 col-form-label " style="padding : 0; margin:0;">City </label> --}}
                        <div class="col-md-12">
                            <select class="form-control" name="city" id="city">
                                <option value="" selected hidden>City</option>
                                @foreach($cities as $city)
                                    <option value="{{$city}}">{{$city}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 row mt-1 mb-1">
                        {{-- <label for="name" class="col-md-4 col-form-label " style="padding : 0; margin:0;">Name </label> --}}
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Enter name here" name="name" id="city">
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>    
            </form>

        </div>
    </div>
</div>

<script>
    $('#city').on('change', function() {
        $('#state').empty();
        $('#state').html('<option selected value="">Loading...</option>');
        $.post("{{ url('get-state')}}", 
				{ city: $(this).val(), _token: '{{csrf_token()}}' }, 
				function(data) {
					var state = $('#state');
					state.empty();
			            state.append("<option selected value='"+ data[0] +"'>" + data[0] + "</option>");
                });
    });
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

@endsection
