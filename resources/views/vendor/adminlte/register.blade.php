@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.register_message') }}</p>
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                           placeholder="{{ trans('adminlte::adminlte.full_name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                    <input type="number" name="mobile_no" class="form-control" value="{{ old('mobile_no') }}"
                           placeholder="Enter mobile no">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('mobile_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile_no') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('blood-group') ? 'has-error' : '' }}">
                    <select name="blood-group" required id="blood-group" class="form-control">
                        <option value="" disabled selected hidden>Select your blood group</option>
                        <option value="A+">A+</option>
                        <option value="B+">B+</option>
                        <option value="AB+">AB+</option>
                        <option value="O+">O+</option>
                        <option value="A-">A-</option>
                        <option value="B-">B-</option>
                        <option value="AB-">AB-</option>
                        <option value="O-">O-</option>
                    </select>
                    <span class=" form-control-feedback" style="color:red;"> <i class="glyphicon glyphicon-tint"></i> </span>
                    @if ($errors->has('blood-group'))
                        <span class="help-block">
                            <strong>{{ $errors->first('blood-group') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('state') ? 'has-error' : '' }}">
                        <select type="text" required class="form-control" name="state" id="state">
                                <option value="" selected hidden>State</option>
                        </select>
                    <span class="glyphicon glyphicon-globe form-control-feedback"></span>
                    @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('city') ? 'has-error' : '' }}">
                        <select class="form-control" name="city" id="city">
                                <option value="" selected hidden>City</option>
                        </select>
                    <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >{{ trans('adminlte::adminlte.register') }}</button>
            </form>
            <div class="auth-links">
                <a href="{{ url(config('adminlte.login_url', 'login')) }}"
                   class="text-center">{{ trans('adminlte::adminlte.i_already_have_a_membership') }}</a>
            </div>
        </div>

        <script>
            $('#state').html('<option selected value="">Loading...</option>');
                $.post("{{ url('get-all-city-state')}}", 
                        {_token: '{{csrf_token()}}' }, 
                        function(data) {
                            var state = $('#state');
                            state.empty();
                            $('#state').html('<option hidden selected value="">State</option>');
                            $.each(data['states'], function(element) {
                                state.append("<option value='"+ data['states'][element] +"'>" + data['states'][element] + "</option>");
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

        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
