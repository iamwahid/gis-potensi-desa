<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/frontend.css')) }}
        <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
        
        @stack('after-styles')
    </head>
    <body>
        <div id="app">
            @include('includes.partials.logged-in-as')
            @include('frontend.includes.nav')
            
            <div class="container">
                @include('includes.partials.messages')
                @yield('content')
            </div><!-- container -->
        </div><!-- #app -->

        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!}
        {!! script(mix('js/frontend.js')) !!}
        <script>
        var available_marker = JSON.parse('{!!json_encode(config("gisdesa.value.desa.marker.available"))!!}')
        </script>
        <script src="{{asset('js/vendor/leaflet.js')}}"></script>
        {{-- <script src="https://kit.fontawesome.com/4da986243c.js" crossorigin="anonymous"></script> --}}
        <script src="{{asset('js/vendor/leaflet.awesome-markers.js')}}"></script>
        <script src="{{asset('js/vendor/leaflet.draw.js')}}"></script>
        <script src="{{asset('js/map-init.js')}}"></script>
        @stack('after-scripts')

        @include('includes.partials.ga')
    </body>
</html>
