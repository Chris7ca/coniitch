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
                    a más tardar el día <b>domingo 31 de marzo del 2019 a las 23:59 horas</b>, hora del centro de México.</p>
                    <p>Una vez se haya registrado y completado la información solicitada por la plataforma, deberá ir a la pestaña <b>Convocatoria</b> y leer cuidadosamente las 
                    instrucciones para enviar su trabajo.</p>

                    <p>Así mismo le recordamos que el sistema solo permite recibir un trabajo por autor/persona. Si usted requiere enviar más de un trabajo, sus co-autores podrán registrarlo. Si tiene dudas contáctenos al correo <b class="text-secondary">trabajos.coniitch@uaem.mx</b></p>

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

                    <h4 class="uk-text-muted">Tipos de trabajos</h4>
                    <hr class="uk-divider-small">

                    <p class="uk-margin-medium-top">Los trabajos libres tendrán dos categorías de presentación: <b>ponencias orales</b> o <b>carteles</b>. La categoría será elegida por el 
                    presentador en el sistema de envío de trabajos, aunque el comité científico se reserva la posibilidad de sugerir un formato de presentación diferente al 
                    elegido por cuestiones temáticas y/o volumen de trabajos recibidos.</p>

                    <p>Con la finalidad de promover una cultura que distinga la importancia y contribución de los carteles, el comité científico ha decidido otorgar un reconocimiento a la 
                    calidad de los mejores carteles durante la conclusión del evento, distinguiendo al primero, segundo y tercer lugar.</p>

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

                    <h4 class="uk-text-muted">Especificaciones</h4>
                    <hr class="uk-divider-small">

                    <p class="uk-margin-medium-top">Los trabajos libres podrán ser: investigaciones, trabajos teóricos, epistemológicos, informes técnicos o experiencias 
                    documentadas en general. La extensión de los resúmenes deberá ser de un <b>mínimo de 250 palabras</b> y un <b>máximo de 300 palabras</b>, sin  imágenes y sin tablas. 
                    Los resúmenes serán publicados en línea en la página del CITPsi y del congreso.</p>
                    <p>Los trabajos aceptados para la sesión de carteles deberán ajustarse a las siguientes especificaciones técnicas:</p>
                    <ul>
                        <li>Dimensión del cartel: 120 cm. de alto por 90 cm. de ancho.</li>
                        <li>Título: tamaño de letra en un rango de 100 a 130 pts.</li>
                        <li>Texto en un rango de 24 a 48 pts.</li>
                        <li>Se deberá colocar la ficha de identificación (título del trabajo, nombre de autor(es), correo electrónico del autor de correspondencia) en la parte superior.</li>
                    </ul>

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
                    a más tardar el día<b> domingo 14 de abril de 2019</b>.</p>
                    <p>Los trabajos aceptados serán incluidos en el programa de sesiones y publicados en línea en la página del CITPsi y del congreso, siempre y cuando al menos uno 
                    de los autores hayan realizado su pago de inscripción al congreso, teniendo como fecha límite el <b>sábado 4 de mayo de 2019</b>.</p>

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
