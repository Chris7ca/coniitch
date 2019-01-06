<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="3er Congreso Internacional de Investigación Transdisciplinar en Ciencias Humanas">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#3A6073">
        <meta name="mobile-web-app-capable" content="yes">

        <!-- Safari -->
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <title>CONIITCH - @yield('title')</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Quicksand|Work+Sans:300,400" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/site.css') }}">
        <style>
            html, body {
                background-color: #f9f9fb !important;
            }
        </style>
    </head>
    <body>
        
        <main id="app">
        
            <header class="uk-background-fixed uk-background-cover uk-background-top-center uk-light" data-src="{{ asset('images/image-hero-app.jpg') }}" uk-img>
                
                <div class="gradient-background-top">

                    <menu-app :user="{{ json_encode(Auth::user()) }}"></menu-app>

                    <section class="uk-container uk-light uk-margin-large uk-padding">
                        <div class="uk-grid uk-grid-divider" uk-grid>
                            <div>
                                <a href="{{ route('app.index') }}">
                                    <img data-src="{{ asset('images/coniitch.png') }}" width="50px" uk-img>
                                </a>
                            </div>
                            <div>
                                <h1 class="light-text">@yield('subtitle')</h1>
                            </div>
                        </div>
                    </section>
                </div>
            </header>
            
            @yield('content') 
            
            @yield('modals')
    
        </main>

        @routes
        
        @stack('js')
        <script src="{{ asset('js/uikit.min.js') }}" defer></script>
        <script src="{{ asset('js/uikit-icons.min.js') }}" defer></script>
    </body>
</html>
