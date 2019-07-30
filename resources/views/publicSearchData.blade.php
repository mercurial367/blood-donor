@extends('welcome')
@section('publicFunctions')
<div class="card mt-4">
    <div class="card-header bg-primary text-light"> <b> Search Donors </b></div>
    <div class="card-body">
        <div class="container">
            <div class="col-md-12 text-center">
            <a name="modify" id="modify" class="btn btn-primary" href="/" role="button">Modify Search</a>
            </div>
        <hr style="color:red; height: 1px; border: 1px solid #000; background-color:red;">
        <div class="container" style="padding-top:1vh;">

            @if(count($donors) > 0)
            <div class="container table-responsive pt-3 ">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Blood Group</th>
                            <th>Mobile No</th>
                            <th>City</th>
                            <th>State</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donors as $donor)
                        <tr>
                            <td>{{$donor->name}}</td>
                            <td>{{$donor->blood_group}}</td>
                            <td>{{$donor->mobile_no}}</td>
                            <td>{{$donor->city}}</td>
                            <td>{{$donor->state}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class='col-md-12'>
                <div class="float-right" style="padding-top:1vh;">
                    {{$donors->links()}}
                </div>
                
            </div>
            @else
            <div class="alert alert-info"> No Data Found</div>
            @endif

        </div>
    </div>
</div>
@endsection
