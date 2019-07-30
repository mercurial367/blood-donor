@extends('adminlte::page')

@section('title', 'Rakta | Profile')

@section('content_header')
    <h1>View All Users</h1>
@stop

@section('content')
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