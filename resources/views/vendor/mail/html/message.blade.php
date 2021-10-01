@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ env('APP_NAME') }}  {{ env('APP_TAGLINE') }}
        @endcomponent
    @endslot
    {{ $slot }}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
    @slot('footer')
        @component('mail::footer')
            ©{{ date('Y') }} {{ config('app.name') }}
        @endcomponent
    @endslot
@endcomponent
