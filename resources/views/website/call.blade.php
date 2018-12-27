@extends('layouts.site')

@section('title', 'Convocatoria')

@section('content')
    
    <main class="uk-background-cover" data-src="{{ asset('images/call.jpg') }}" uk-img>
            
        <div class="gradient-background-top uk-position-relative" uk-height-viewport="offset-bottom: 30">
            
            @include('layouts.headersite')
            
            <article class="uk-container uk-text-center uk-light uk-position-center uk-margin" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 500">
                
                <h1>Registro de trabajos</h1>
                
            </article>
            
        </div>
        
    </main>

    <section class="uk-container uk-margin-large" style="padding-top: 80px; padding-bottom: 80px;">

        <h2>Convocatoria para registrar trabajos</h2>
        <hr class="uk-divider-small">

        <div class="uk-grid uk-grid-match uk-margin-large" uk-grid>
            
            <div class="uk-width-1-3@m" uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">
                <div class="uk-flex uk-flex-middle uk-flex-center">
                    <h2 class="uk-heading-hero">1</h2>
                </div>
            </div>

            <div class="uk-width-2-3@m" uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">
                <article class="uk-padding uk-padding-remove-horizontal">

                    <h4 class="uk-text-muted">Registro</h4>
                    <hr class="uk-divider-small">

                    <p class="uk-margin-medium-top">Para ser considerados, los resúmenes de los trabajos orales y carteles deberán <a href="{{ route('site.register') }}" class="text-secondary">registrarse</a> 
                    a más tardar el día <b>domingo 10 de febrero del 2019 a las 23:59 horas</b>, hora del centro de México.</p>

                </article>
            </div>

        </div>

        <div class="uk-grid uk-grid-match uk-margin-large" uk-grid>
            
            <div class="uk-width-1-3@m" uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">
                <div class="uk-flex uk-flex-middle uk-flex-center">
                    <h2 class="uk-heading-hero">2</h2>
                </div>
            </div>

            <div class="uk-width-2-3@m uk-flex-first@m" uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">
                <article class="uk-padding uk-padding-remove-horizontal">

                    <h4 class="uk-text-muted">Especifícaciones</h4>
                    <hr class="uk-divider-small">

                    <p class="uk-margin-medium-top">Los trabajos libres podrán ser: investigaciones, trabajos teóricos, epistemológicos, informes técnicos o experiencias 
                    documentadas en general. La extensión de los resúmenes deberá ser de un <b>mínimo de 250 palabras</b> y un <b>máximo de 300 palabras</b>, sin  imágenes y sin tablas. 
                    Los resúmenes serán publicados en línea en la página del CITPsi y del congreso.</p>

                </article>
            </div>

        </div>

        <div class="uk-grid uk-grid-match uk-margin-large" uk-grid>
            
            <div class="uk-width-1-3@m" uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">
                <div class="uk-flex uk-flex-middle uk-flex-center">
                    <h2 class="uk-heading-hero">3</h2>
                </div>
            </div>

            <div class="uk-width-2-3@m" uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">
                <article class="uk-padding uk-padding-remove-horizontal">

                    <h4 class="uk-text-muted">Tipos de trabajos</h4>
                    <hr class="uk-divider-small">

                    <p class="uk-margin-medium-top">Los trabajos libres tendrán dos categorías de presentación: <b>ponencias orales</b> o <b>carteles</b>. La categoría será elegida por el 
                    presentador en el sistema de envío de trabajos, aunque el comité científico se reserva la posibilidad de sugerir un formato de presentación diferente al 
                    elegido por cuestiones temáticas y/o volumen de trabajos recibidos.</p>

                </article>
            </div>

        </div>

        <div class="uk-grid uk-grid-match uk-margin-large" uk-grid>
            
            <div class="uk-width-1-3@m" uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">
                <div class="uk-flex uk-flex-middle uk-flex-center">
                    <h2 class="uk-heading-hero">4</h2>
                </div>
            </div>

            <div class="uk-width-2-3@m uk-flex-first@m" uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">
                <article class="uk-padding uk-padding-remove-horizontal">

                    <h4 class="uk-text-muted">Nota</h4>
                    <hr class="uk-divider-small">

                    <p class="uk-margin-medium-top">Posterior al registro y subida del resumen en la página correspondiente, los autores recibirán una notificación 
                    informando que su documento se recibió exitosamente. Esto <b>NO</b> significa la aceptación final del trabajo. </p>
                    <p>Los resúmenes de trabajos (tanto orales como carteles) deberán pasar por el dictamen del Comité Científico. Los resultados serán enviados vía correo electrónico 
                    el día <b>lunes 11 de marzo de 2019</b>.</p>
                    <p>Los trabajos aceptados serán incluidos en el programa de sesiones y publicados en en línea en la página del CITPsi y del congreso, siempre y cuando al menos uno 
                    de los autores hayan realizado su pago de inscripción al congreso, teniendo como fecha límite el <b>31 de marzo de 2017</b>.</p>

                </article>
            </div>

        </div>

    </section>

    <section class="uk-margin-large uk-background-cover" data-src="{{ asset('images/email.jpg') }}" uk-img style="margin-bottom: 190px;">

        <div class="gradient-background-left uk-margin-large" style="padding-top: 90px; padding-bottom: 90px;">

            <div class="uk-container uk-light" uk-scrollspy="target: > *; cls:uk-animation-slide-left; delay: 500">

                <h2>¿Tienes dudas?</h2>
                <hr class="uk-divider-small">

                <p>Escríbenos un correo a: <a href="mailto:coniitch.citpsi@uaem.mx">coniitch.citpsi@uaem.mx</a> y con gusto te ayudaremos</p>

            </div>

        </div>

    </section>

@endsection