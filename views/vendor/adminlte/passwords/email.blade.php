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
            <p class="login-box-msg">{{ __('adminlte::adminlte.password_reset_message') }}</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ url(config('adminlte.password_email_url', 'password/email')) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ isset($email) ? $email : old('email') }}"
                           placeholder="{{ __('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('adminlte::adminlte.send_password_reset_link') }}
                </button>
            </form>
        </div>
    </div>
@stop
@section('adminlte_js')
    @yield('js')
@stop
