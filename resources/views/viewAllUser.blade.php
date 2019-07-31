@extends('adminlte::page')

@section('title', 'Rakta | Profile')

@section('content_header')
    <h1>View All Users</h1>
@stop
<style>

.alert {
  -webkit-animation: seconds 1.0s forwards;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-delay: 5s;
  animation: seconds 1.0s forwards;
  animation-iteration-count: 1;
  animation-delay: 5s;
  width: 30%;
    
}
@-webkit-keyframes seconds {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    left: -9999px; 
    position: absolute;   
  }
}
@keyframes seconds {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    left: -9999px;
    position: absolute;     
  }
}
</style>
@section('content')

@if(Session::has('blocked'))
<div id=mainAlertMessage class="alert alert-success alert-dismissible" id="hideMe" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <div style="text-align: center"><strong>Blocked <br> </strong> {{Session::get('blocked')}}</div>
</div>
@endif
@if(Session::has('unblocked'))
<div id=mainAlertMessage class="alert alert-warning alert-dismissible" id="hideMe" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <div style="text-align: center"><strong>Unblocked <br> </strong> {{Session::get('unblocked')}}</div>
</div>


@endif
@if(Session::has('delete'))
<div id=mainAlertMessage class="alert alert-success alert-dismissible" id="hideMe" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <div style="text-align: center"><strong>Deleted <br> </strong> {{Session::get('delete')}}</div>
</div>
@endif
    <div class="card card-primary">
        <div class="card-header bg-primary"> All Users</div>
        <div class="card-body">
            <div class="text-center">
                    {{-- @if (isset($users)) --}}
                        <div class="container table-responsive  ">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        
                                        <th>Action</th>
                                        <th>Delete User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    @if($user->id != $self->id )
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                                {{$user->active? 'Active' : 'Blocked'}}
                                        </td>
                                        <td>
                                        <form action="/admin/status-change/{{$user->id}}" method="POST">
                                            @csrf
                                            <input name="id" id="id" type="text" hidden value="{{$user->id}}">
                                            <button type="submit" class="btn {{$user->active? 'btn-primary' : 'btn-danger'}}">
                                                    {{$user->active? 'Block' : 'Unblock'}}
                                            </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="/admin/user-delete/{{$user->id}}" method="POST">
                                                @csrf
                                                <input name="id" id="id" type="text" hidden value="{{$user->id}}">
                                                <button type="submit" class="btn btn-danger" title="Delete User">
                                                        Delete
                                                </button>
                                                </form>
                                        </td>
                                        
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class='col-md-12'>
                                <div class="pull-right" style="padding-top:1vh;">
                                    {{$users->links()}}
                                </div>
                                
                            </div>
                    {{-- @endif --}}
            </div>
        </div>
    </div>
@stop