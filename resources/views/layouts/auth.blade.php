<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @env('production')
            
            @include('analytics')

        @endenv('testing')
       
    </head>
    <body>
        
        <main class="uk-position-relative" uk-height-viewport>
        
            <header class="uk-position-absolute uk-width-1-1">
    
                <nav class="uk-navbar-container uk-container uk-container-large uk-navbar-transparent" uk-navbar>
                    
                    <div class="uk-navbar-left">
                        <ul class="uk-navbar-nav" uk-scrollspy="target: > li; cls:uk-animation-fade; delay: 400">
                            <li class="uk-active">
                                <a href="{{ route('site.index') }}" role="link" title="Inicio">
                                    <img data-src="{{ asset('logos/coniitch.png') }}" width="40" uk-img>
                                </a>
                            </li>
                        </ul>
                    </div>
            
                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav" uk-scrollspy="target: > li; cls:uk-animation-fade; delay: 500">
                            <li class="uk-visible@m {{ activeLink('/') }}">
                                <a href="{{ route('site.index') }}" role="link">Inicio</a>
                            </li>
                            <li class="uk-visible@m {{ activeLink('programa') }}">
                                <a href="{{ route('site.programme') }}" role="link">Programa</a>
                            </li>
                            <li class="uk-visible@m {{ activeLink('convocatoria') }}">
                                <a href="{{ route('site.announcement') }}" role="link">Convocatoria</a>
                            </li>
                            <li class="uk-visible@m {{ activeLink('costos') }}">
                                <a href="{{ route('site.pricing') }}" role="link">Costos</a>
                            </li>
                            <li class="uk-visible@m {{ activeLink('registro') }}">
                                <a href="{{ route('site.register') }}" role="link">Registro</a>
                            </li>
                            <li class="uk-visible@m {{ activeLink('acceder') }}">
                                <a href="{{ route('site.login') }}" role="link">Acceder</a>
                            </li>
                            <li class="uk-hidden@m">
                                <a href="#menu-mobile" role="menu" title="Menu" uk-icon="icon: menu; ratio: 1.6" uk-toggle></a>
                            </li>
                        </ul>
                    </div>
    
                </nav>
    
            </header>
    
            <div class="uk-grid uk-grid-collapse uk-grid-match" uk-grid>
                         
                <div class="uk-width-1-3 uk-visible@m">
                    <div class="uk-background-cover uk-background-center-right" data-src="{{ asset('images/laptop.jpg') }}" uk-img>
                        <div class="gradient-background-bottom" style="height: 100%;">
    
                        </div>
                    </div>
                </div>
    
                <div class="uk-width-2-3@m">
                    <div class="uk-flex uk-flex-middle uk-flex-center uk-padding-large"  uk-height-viewport>
                        <div class="uk-width-1-3@xl uk-width-2-3@m">
    
                            @yield('content')
    
                        </div>
                    </div>
                </div>
                
            </div>
            
        </main>
    
        <!-- Modals -->
    
        <div id="menu-mobile" class="uk-modal-full" uk-modal>
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                
                <div class="uk-flex uk-flex-center uk-flex-middle uk-padding" uk-height-viewport>
    
                    <div>
    
                        <h2 class="uk-h1">MENÚ</h2>
                        <hr>
    
                        <ul class="uk-nav uk-nav-default uk-text-center">
                            <li>
                                <a href="{{ route('site.index') }}" role="link">Inicio</a>
                            </li>
                            <li>
                                <a href="{{ route('site.programme') }}" role="link">Programa</a>
                            </li>
                            <li>
                                <a href="{{ route('site.announcement') }}" role="link">Convocatoria</a>
                            </li>
                            <li>
                                <a href="{{ route('site.pricing') }}" role="link">Costos</a>
                            </li>
                            <li>
                                <a href="{{ route('site.register') }}" role="link">Registro</a>
                            </li>
                            <li>
                                <a href="{{ route('site.login') }}" role="link">Acceder</a>
                            </li>
                        </ul>
    
                        <ul class="uk-iconnav uk-flex uk-flex-center uk-margin-large">
                            <li><a role="link" href="https://www.facebook.com/CITPsi/" target="_blank" uk-icon="icon: facebook"></a></li>
                            <li><a role="link" href="https://twitter.com/citpsi?lang=es" target="_blank" uk-icon="icon: twitter"></a></li>
                        </ul>
    
                    </div>
    
                </div>
    
            </div>
        </div>

        @stack('js')
        <script src="{{ asset('js/uikit.min.js') }}" defer></script>
        <script src="{{ asset('js/uikit-icons.min.js') }}" defer></script>
    </body>
</html>
