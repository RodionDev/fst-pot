@extends('adminlte::master')
@section('adminlte_css')
    @yield('css')
@stop
@section('body_class', 'login-page')
@section('body')
    <div class="auth-box login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}">@include('svg.logo')</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">{{ __('adminlte::adminlte.login_message') }}</p>
            <form class="backend-gate-form" action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ __('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           autocomplete="new-password"
                           placeholder="{{ __('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">{{ __('adminlte::adminlte.remember_me') }}</label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('adminlte::adminlte.sign_in') }}
                        </button>
                    </div>
                </div>
            </form>
            <p class="text-center">
                <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}">
                    {{ __('adminlte::adminlte.i_forgot_my_password') }}
                </a>
            </p>
            @if (config('adminlte.register_url', 'register'))
                <p class="text-center">
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}">
                        {{ __('adminlte::adminlte.register_a_new_membership') }}
                    </a>
                </p>
            @endif
            <p class="text-center"><a href="/">Zurück zur Hauptseite</a></p>
        </div>
    </div>
@stop
@section('adminlte_js')
    @yield('js')
@stop
