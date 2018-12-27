@extends('layouts.site')

@section('title', 'Nosotros')

@section('content')
    
    <main class="uk-background-cover" data-src="{{ asset('images/citpsi.JPG') }}" uk-img>
            
        <div class="gradient-background-top uk-position-relative" uk-height-viewport="offset-bottom: 30">
            
            @include('layouts.headersite')
            
            <article class="uk-container uk-text-center uk-light uk-position-center uk-margin" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 500">
                
                <h1>Sobre nosotros</h1>
                
            </article>
            
        </div>
        
    </main>

    <section class="uk-container uk-margin-large" style="padding-top: 80px; padding-bottom: 100px;">

        <article>

            <h2>Centro de Investigación Transdisciplinar en Psicología</h2>
            <h4 class="uk-text-muted uk-margin-remove-top">UNIVERSIDAD AUTONÓMA DEL ESTADO DE MORELOS</h4>
            <hr class="uk-divider-small">

            <p class="uk-margin-medium-top">Somos un centro de investigación en donde desarrollamos actividades de docencia, extensión y gestión en torno a los diversos 
            aspectos de los fenómenos psicológicos en distintos contextos desde una perspectiva transdisciplinar y con un sentido de 
            responsabilidad social, contribuyendo con ello al mejoramiento de las condiciones de vida del ser humano.</p>

        </article>
    
    </section>

@endsection