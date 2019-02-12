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
            #preloader-page{
                position: absolute;
                height: 100vh;
                background-color: #f9f9fb;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                width: 100%;
                z-index: 1000 !important;
            }
        </style>
    </head>
    <body>

        <div id="preloader-page" class="uk-flex uk-flex-center uk-flex-middle">
            <div class="uk-text-center">
                <h6>Cargando</h6>
                <img src="{{ asset('svg/spinner.svg') }}" width="100">
            </div>
        </div>
        
        <main id="app">
        
            <header class="uk-background-fixed uk-background-cover uk-background-top-center" data-src="{{ asset('images/image-hero-app.jpg') }}" uk-img>
                
                <div class="gradient-background-top">
                    
                    <nav class="uk-container uk-navbar-container uk-navbar-transparent" uk-navbar="mode: click">
        
                        <div class="uk-navbar-left">
                            <ul class="uk-navbar-nav">

                                <li class="uk-hidden@m item-light">
                                    <a href="#menu-mobile" uk-icon="icon: menu; ratio: 1.5" uk-toggle></a>
                                </li>

                                <li class="uk-visible@m item-light">
                                    <a href="{{ route('app.index') }}">Inicio</a>
                                </li>

                                @if ( Auth::user()->isRoot() )
                                    <li class="uk-visible@m item-light">
                                        <a href="{{ route('app.users.view') }}">Usuarios</a>
                                    </li>
                                    <li class="uk-visible@m item-light">
                                        <a href="{{ route('app.roles.view') }}">Roles</a>
                                    </li>

                                @elseif ( Auth::user()->isPublicRelations() )
                                    <li class="uk-visible@m item-light">
                                        <a href="{{ route('app.sponsors.view') }}">Patrocinadores</a>
                                    </li>

                                @elseif ( Auth::user()->isAdmin() )
                                    <li class="uk-visible@m item-light">
                                        <a href="{{ route('app.criterias.view') }}">Criterios</a>
                                    </li>
                                    <li class="uk-visible@m item-light">
                                        <a href="{{ route('app.admin.works.view') }}">Trabajos</a>
                                    </li>

                                @elseif ( Auth::user()->isCongressman() )
                                    <li class="uk-visible@m item-light">
                                        <a href="{{ route('app.announcement.view') }}">Convocatoria</a>
                                    </li>
                                
                                @elseif ( Auth::user()->isRevisor() )
                                    <li class="uk-visible@m item-light">
                                        <a href="{{ route('app.revisors.works.view') }}">Trabajos</a>
                                    </li>
                                @endif    

                            </ul>
                        </div>
                
                        <div class="uk-navbar-right">
                            <ul class="uk-navbar-nav">
                                <widget-notifications></widget-notifications>
                                <li class="item-light">
                                    <a role="button"> 

                                        <img data-src="{{ avatar(Auth::user()->avatar) }}" class="avatar-xs uk-preserve-width uk-margin-small-right" uk-img>

                                        {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                                        
                                        <span uk-icon="triangle-down"></span>
                                    </a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li class="uk-nav-header">
                                                <small>Opciones</small>
                                            </li>
                                            <li>
                                                <a href="{{ route('app.profiles.view') }}">
                                                    <span class="uk-margin-small-right" uk-icon="icon: user"></span> Editar Perfil
                                                </a>
                                            </li>
                                            <li>
                                                <a role="button" @click="logout">
                                                    <span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> Cerrar Sesión
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                
                    </nav>

                    <section class="uk-container uk-light uk-margin-large uk-padding">
                        <div class="uk-grid uk-grid-divider" uk-grid>
                            <div>
                                <a href="{{ route('app.index') }}">
                                    <img data-src="{{ asset('images/coniitch.png') }}" width="50px" uk-img>
                                </a>
                            </div>
                            <div>
                                <h1 class="light-text">@yield('hero')</h1>
                            </div>
                        </div>
                    </section>
                </div>
            </header>
            
            @yield('content') 
            
            @yield('modals')

            <div id="menu-mobile" class="uk-modal-full" uk-modal>
                <div class="uk-modal-dialog">
                    <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                    
                    <div class="uk-flex uk-flex-center uk-flex-middle uk-padding" uk-height-viewport>
        
                        <div>
        
                            <h2 class="uk-h1">MENÚ</h2>
                            <hr>
        
                            <ul class="uk-nav uk-nav-default uk-text-center">
                               
                                <li>
                                    <a href="{{ route('app.index') }}">Inicio</a>
                                </li>

                                @if ( Auth::user()->isRoot() )
                                    <li>
                                        <a href="{{ route('app.users.view') }}">Usuarios</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('app.roles.view') }}">Roles</a>
                                    </li>

                                @elseif ( Auth::user()->isPublicRelations() )
                                    <li>
                                        <a href="{{ route('app.sponsors.view') }}">Patrocinadores</a>
                                    </li>

                                @elseif ( Auth::user()->isAdmin() )
                                    <li>
                                        <a href="{{ route('app.criterias.view') }}">Criterios</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('app.admin.works.view') }}">Trabajos</a>
                                    </li>

                                @elseif ( Auth::user()->isCongressman() )
                                    <li>
                                        <a href="{{ route('app.announcement.view') }}">Convocatoria</a>
                                    </li>

                                @elseif ( Auth::user()->isRevisor() )
                                    <li>
                                        <a href="{{ route('app.revisors.works.view') }}">Trabajos</a>
                                    </li>
                                @endif   

                            </ul>
        
                        </div>
        
                    </div>
        
                </div>
            </div>
    
        </main>

        @routes
        
        @stack('js')
        <script src="{{ asset('js/uikit.min.js') }}" defer></script>
        <script src="{{ asset('js/uikit-icons.min.js') }}" defer></script>
    </body>
</html>
