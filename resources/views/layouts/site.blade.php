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
        <link rel="stylesheet" href="{{ asset('css/site.css') }}">

        {{-- @include('analytics') --}}
       
    </head>
    <body>
        
        @yield('content')

        <footer class="uk-background-secondary uk-light uk-padding-large uk-padding-remove-horizontal">

            <div class="uk-container">
    
                <div class="uk-flex uk-flex-middle">
                    <div uk-scrollspy="cls:uk-animation-fade; delay: 400">
                        <img data-src="{{ asset('images/uaem-white.png') }}" width="100px" alt="Logo UAEM" uk-img>
                    </div>
                    <div class="uk-margin-medium-left" uk-scrollspy="cls:uk-animation-fade; delay: 400">
                        <img data-src="{{ asset('images/citpsi-white.png') }}" width="150px" alt="Logo CITPSI" uk-img>
                    </div>
                </div>
    
                <div class="uk-grid uk-grid-medium uk-flex-around uk-margin-large" uk-grid>
    
                    <div>
    
                        <div uk-grid>
    
                            <div uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 400">
                                <h5 uk-scrollspy="cls:uk-animation-fade; delay: 400">Acerca de</h5>
                                <hr class="uk-divider-small">
                                <ul class="uk-nav uk-nav-default primary-font" uk-scrollspy="target: > li; cls:uk-animation-fade; delay: 400">
                                    <li class="{{ activeLink('nosotros') }}">
                                        <a role="link" href="{{ route('site.aboutus') }}">Sobre nosotros</a>
                                    </li>
                                    <li class="{{ activeLink('contacto') }}">
                                        <a role="link" href="{{ route('site.contact') }}">Contacto</a>
                                    </li>
                                    <li class="{{ activeLink('terminos') }}">
                                        <a role="link" href="{{ route('site.terms') }}">Terminos y condiciones</a>
                                    </li>
                                    <li class="{{ activeLink('privacidad') }}">
                                        <a role="link" href="{{ route('site.privacy') }}">Política de privacidad</a>
                                    </li>
                                </ul>
                            </div>
    
                            <div uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 400">
                                <h5 uk-scrollspy="cls:uk-animation-fade; delay: 400">Congreso</h5>
                                <hr class="uk-divider-small">
                                <ul class="uk-nav uk-nav-default primary-font" uk-scrollspy="target: > li; cls:uk-animation-fade; delay: 400">
                                    <li class="{{ activeLink('programa') }}">
                                        <a role="link" href="{{ route('site.programme') }}">Programa</a>
                                    </li>
                                    <li class="{{ activeLink('convocatoria') }}">
                                        <a role="link" href="{{ route('site.call') }}">Convocatoria</a>
                                    </li>
                                    <li class="{{ activeLink('directorio') }}">
                                        <a role="link" href="{{ route('site.directory') }}">Directorio</a>
                                    </li>
                                    <li class="{{ activeLink('registro') }}">
                                        <a role="link" href="{{ route('site.register') }}">Registro</a>
                                    </li>
                                </ul>
                            </div>
    
                        </div>
    
                    </div>
    
                    <div>
    
                        <div>
                            <a role="link" href="https://www.google.com/maps/?q=18.981888,-99.235803" target="_blank" class="uk-link-reset" uk-scrollspy="cls: uk-animation-fade; delay: 400">
                                <span uk-icon="icon: location"></span> Av. Universidad 1001, Col. Chamilpa, C.P. 62209, Cuernavaca, Morelos, México.
                            </a>
                            <p uk-scrollspy="cls: uk-animation-fade; delay: 400">
                                <span uk-icon="icon: receiver" class="uk-icon"></span> 
                                <a class="uk-link-reset" href="mailto:citpsi@uaem.mx">coniitch.citpsi@uaem.mx</a>
                            </p>
                            <ul class="uk-iconnav" uk-scrollspy="target: > li; cls:uk-animation-fade; delay: 400">
                                <li><a role="link" href="https://www.facebook.com/CITPsi/" target="_blank" uk-icon="icon: facebook"></a></li>
                                <li><a role="link" href="https://twitter.com/citpsi?lang=es" target="_blank" uk-icon="icon: twitter"></a></li>
                            </ul>
                        </div>
    
                    </div>
    
                </div>
    
            </div>
    
        </footer>

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
                                <a href="{{ route('site.call') }}" role="link">Convocatoria</a>
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

        @yield('modals')

        <script src="{{ asset('js/uikit.min.js') }}" defer></script>
        <script src="{{ asset('js/uikit-icons.min.js') }}" defer></script>
    </body>
</html>
