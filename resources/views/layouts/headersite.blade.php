<header uk-sticky="show-on-up: true; cls-active: uk-dark sticky-header; cls-inactive: uk-light">

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