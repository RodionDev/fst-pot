@extends('frontend.layouts.app')
@section('pageTitle', 'Produkt')
@section('content')
<div class="container">
    <h1 class="page-heading page-heading">Produkt</h1>
    <div class="row justify-content-center align-items-center content mb-5">
        <div class="col-lg-4">
            <p>VSPOT ist ein CMS zur Erstellung und Verwaltung von Geräten, Benutzern und Inhalten für Digital Signage.</p>
            <p>Generierte Inhalte lassen sich über eine dedizierte Mobile- oder Desktop-Anwendung, über eine JSON-API oder eine reguläre Webpage abrufen.</p>
        </div>
        <div class="col-lg-8">
            <a href="{{asset('media/images/backend-demo.gif')}}" data-lightbox="image-1" data-title="Ansicht des Backends">
                <img class="frame-shadow" src="{{asset('media/images/backend-demo.gif')}}" alt="Ansicht des Backends" title="Ansicht des Backends">
            </a>
        </div>
    </div>
    @php
    $images = [
        ['file' => 'dashboard', 'title'=>'Dashboard'],
        ['file' => 'users', 'title'=>'Benutzerverwaltung'],
        ['file' => 'users-edit', 'title'=>'Benutzer editieren'],
        ['file' => 'devices', 'title'=>'Geräteverwaltung'],
        ['file' => 'devices-create', 'title'=>'Gerät hinzufügen'],
        ['file' => 'devices-edit', 'title'=>'Gerät editieren'],
        ['file' => 'channels', 'title'=>'Verwaltung der Channels'],
        ['file' => 'channels-create', 'title'=>'Channel anlegen'],
        ['file' => 'channels-edit', 'title'=>'Channel editieren'],
        ['file' => 'screens', 'title'=>'Verwaltung der Screens'],
        ['file' => 'screens-create', 'title'=>'Screen anlegen'],
        ['file' => 'screens-edit', 'title'=>'Screen editieren'],
    ];
    @endphp
    <div id="vspot-backend-impressions-gallery" itemscope itemtype="http://schema.org/ImageGallery" class="row justify-content-center text-center">
        @foreach($images as $i=>$img)
        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="col-6 col-sm-4 col-md-3 col-lg-2">
            <a href="{{asset('media/images/backend-demo-' . $img['file'] . '.jpg')}}" itemprop="contentUrl" data-lightbox="backend-impressions" data-title="{{$img['title']}}" data-alt="{{$img['title']}}">
                <img src="{{asset('media/images/backend-demo-thumb-' . $img['file'] . '.jpg')}}" itemprop="thumbnail" alt="{{$img['title']}}" title="{{$img['title']}}" class="img-fluid img-thumbnail"/>
            </a>
            <figcaption itemprop="caption description">{{$img['title']}}</figcaption>
        </figure>
        @endforeach
    </div>
</div>
@endsection
@push('js-bottom')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js" integrity="sha256-CtKylYan+AJuoH8jrMht1+1PMhMqrKnB8K5g012WN5I=" crossorigin="anonymous"></script>
    <script>
        lightbox.option({
            'albumLabel': "VSPOT-Backend: Bild %1 von %2",
            'wrapAround': true,
            'alwaysShowNavOnTouchDevices': true
        })
    </script>
@endpush
