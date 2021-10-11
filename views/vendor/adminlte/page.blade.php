@extends('adminlte::master')
@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop
@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))
@section('body')
    <div class="wrapper">
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
            @else
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle fa5" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ __('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a><i class="fas fa-user fa-fw"></i> {{ auth()->user()->name }}</a>
                        </li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off fa-fw"></i> {{ __('adminlte::adminlte.log_out') }}
                            </a>
                            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST">{{ csrf_field() }}</form>
                        </li>
                        @if(config('adminlte.right_sidebar') and (config('adminlte.layout') != 'top-nav'))
                            <li>
                                <a href="#" data-toggle="control-sidebar" @if(!config('adminlte.right_sidebar_slide')) data-controlsidebar-slide="false" @endif>
                                    <i class="{{config('adminlte.right_sidebar_icon')}}"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>
        @if(config('adminlte.layout') != 'top-nav')
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                </ul>
            </section>
        </aside>
        @endif
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif
            <section class="content-header">
                @yield('content_header')
            </section>
            <section class="content">
                @yield('content')
            </section>
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            @endif
        </div>
        @hasSection('footer')
        <footer class="main-footer">
            @yield('footer')
        </footer>
        @endif
        @if(config('adminlte.right_sidebar') and (config('adminlte.layout') != 'top-nav'))
            <aside class="control-sidebar control-sidebar-{{config('adminlte.right_sidebar_theme')}}">
                @yield('right-sidebar')
            </aside>
            <div class="control-sidebar-bg"></div>
        @endif
    </div>
@stop
@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
