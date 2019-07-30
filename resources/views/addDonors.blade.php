@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
<h1>Edit Profile</h1>
@stop

@section('content')

<div class="card card-primary">
    <div class="card-header bg-primary">Add Donors Data From CSV</div>
    <div class="card-body">
        <form method="POST" action="/admin/donors-csv-add" enctype="multipart/form-data">
            @csrf
            <ul class="alert alert-info" style="list-style:none;">
                <li style="color:#000;"> Please download the CSV file from <b>Download CSV Sample</b> button and add
                    data into it, do not delete header from top of the csv file. </li>
            </ul>
            @if(Session::has('success-msg'))
            <ul class="alert alert-success" style="list-style:none;">
                <li style="color:#000;"> {{Session::get('success-msg')}} </li>
            </ul>
            @endif
            @if(Session::has('error-msg'))
            <ul class="alert alert-danger" style="list-style:none;">
                <li style="color:#000;"> {{Session::get('error-msg')}} </li>
            </ul>
            @endif
            <div class="form-group row">
                <label for="file" class="col-sm-1 col-form-label">Name</label>
                <div class="col-sm-5">
                    <input type="file" required class="form-control" name="file" id="file">
                </div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                </div>
                <div class="col-sm-3">
                    <a name="download-csv" id="download-csv" class="btn btn-primary" href="/admin/download-csv"
                        role="button">Download Sample CSV</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mt-2">
    <div class="card-header bg-primary">Add Donors Data Manually</div>
    <div class="card-body">
        <div class="container">
            <form method="POST" action="/admin/donors-data-add">
                @csrf
                @if($errors->any())
                <ul class="alert alert-danger" style="list-style:none;">
                    @foreach($errors->all() as $error=>$err)
                    <li style="color:#000;"> {{$err}} </li>
                    @endforeach
                </ul>
                @endif

                @if(Session::has('success'))
                <ul class="alert alert-success" style="list-style:none;">
                    <li style="color:#000;"> {{Session::get('success')}} </li>
                </ul>
                @endif

                <div class="form-group row">
                    <label for="name" class="col-sm-1 col-form-label">Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name Here">
                    </div>
                    <label for="mobile_no" class="col-sm-1 col-form-label">Mobile Number</label>
                    <div class="col-sm-5">
                        <input type="number" required class="form-control" name="mobile_no" id="mobile_no"
                            placeholder="Enter your mobile number">
                    </div>
                </div>
                <div class="form-group row">
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
                    <label for="state" class="col-sm-1 col-form-label">State</label>
                    <div class="col-sm-5">
                        <select type="text" required class="form-control" name="state" id="state">
                            <option value="" selected hidden>State</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city" class="col-sm-1 col-form-label">City</label>
                    <div class="col-sm-5">
                        <select class="form-control" name="city" id="city">
                            <option value="" selected hidden>City</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 text-center">
                    <input name="update_btn" id="update_btn" class="btn btn-primary" type="submit" value="Add Data">
                </div>

            </form>
        </div>
    </div>
</div>
</div>
<script>
    $('#state').html('<option selected value="">Loading...</option>');
    $.post("{{ url('get-all-city-state')}}", {
            _token: '{{csrf_token()}}'
        },
        function (data) {
            console.log(data)
            var state = $('#state');
            state.empty();
            $('#state').html('<option hidden selected value="">State</option>');
            $.each(data['states'], function (element) {
                state.append("<option value='" + data['states'][element] + "'>" + data['states'][element] +
                    "</option>");
            });
        });

    $('#state').on('change', function () {
        $('#city').empty();
        $('#city').html('<option selected value="">Loading...</option>');
        $.post("{{ url('get-city')}}", {
                state: $(this).val(),
                _token: '{{csrf_token()}}'
            },
            function (data) {
                var city = $('#city');
                city.empty();
                $('#city').html('<option hidden selected value="">City</option>');
                $.each(data, function (element) {
                    city.append("<option value='" + data[element] + "'>" + data[element] +
                        "</option>");
                });
            });
    });

</script>



@stop
