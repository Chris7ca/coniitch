@extends('layouts.site')

@section('title', 'Contacto')

@section('content')
    
    <main class="uk-background-cover" data-src="{{ asset('images/location.jpg') }}" uk-img>
            
        <div class="gradient-background-top uk-position-relative" uk-height-viewport="offset-bottom: 30">
            
            @include('layouts.headersite')
            
            <article class="uk-container uk-text-center uk-light uk-position-center uk-margin" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 500">
                
                <h1>Contacto</h1>
                
            </article>
            
        </div>
        
    </main>

    <section class="uk-container uk-margin-large" style="padding-top: 80px; padding-bottom: 100px;">

        <div class="uk-grid uk-grid-collapse uk-grid-match uk-child-width-1-2@m" uk-grid>

            <div>
                <div class="min-height">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3774.049495788229!2d-99.2149845845398!3d18.92920318717219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cddfbe0848e337%3A0x9c9f256682bc61eb!2sCentro+de+Investigaci%C3%B3n+Transdiciplinar+en+Psicolog%C3%ADa+-+UAEM!5e0!3m2!1ses!2smx!4v1531878906979" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                </div>
            </div>

            <div>
                <article class="uk-padding">

                    <h4>Ubicación</h4>
                    <hr class="uk-divider-small">

                    <p>Estamos ubicados en Pico de Orizaba No. 1 Esq. Popocatépetl, Col. Los Volcanes, Cuernavaca, Morelos. C.P. 62350. A a media cuadra de Los Belenes; o frente a 
                    la Facultad de Enfermería de la Universidad Autónoma del Estado de Morelos.</p>

                    <p>Nuestro horario de atención es de 9 a.m. a 6 p.m.. Con gusto lo esperamos en nuestras instalaciones para darle mayor información.</p>

                    <h4>¿Cómo contactarnos?</h4>
                    <hr class="uk-divider-small">

                    <p>Para ponerte en contacto con nosotros puedes hacerlo a través de los siguientes medios:</p>

                    <ul>
                        <li>Viniendo personalmente a nuestras instalaciones, dentro del Centro de Investigación Transdisciplinar en Psicología.</li>
                        <li>Llamando a los siguientes teléfonos: 329 79 70 o 316 77 20</li>
                        <li>Escribiendo al correo electrónico: <a href="mailto:coniitch.citpsi@uaem.mx" class="text-secondary">coniitch.citpsi@uaem.mx</a>.</li>
                    </ul>

                </article>
            </div>

        </div>

    </section>

@endsection