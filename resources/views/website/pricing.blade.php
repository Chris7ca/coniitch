@extends('layouts.site')

@section('title', 'Costos')

@section('content')
    
    <main class="uk-background-cover" data-src="{{ asset('images/pricing.jpg') }}" uk-img>
            
        <div class="gradient-background-top uk-position-relative" uk-height-viewport="offset-bottom: 30">
            
            @include('layouts.headersite')
            
            <article class="uk-container uk-text-center uk-light uk-position-center uk-margin" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 500">
                
                <h1>Costos</h1>

                <p>Si deseas registrarte para asegurar tu lugar en el congreso, escribe a <strong>finanzas.coniitch@uaem.mx</strong></p>
                
            </article>
            
        </div>
        
    </main>

    <section class="uk-container uk-margin-large uk-text-center" style="padding-top:80px; padding-bottom: 100px;">

        <h2>Costos de inscripción</h2>
        <hr class="uk-divider-small">

        <div class="uk-grid uk-grid-match uk-grid-large uk-flex-center uk-margin-large" uk-grid>

            <div class="uk-width-2-5@m">
                <article class="uk-card uk-card-default uk-card-body uk-box-shadow-hover-large uk-text-center uk-flex uk-flex-column uk-flex-between">

                    <div>
                        <h3 class="text-secondary">$730.00 MXN</h3>
                        <h5>Estudiantes</h5>

                        <p class="uk-text-meta uk-margin-medium-top">Solo estudiantes que comprueben su estatus académico</p>
                        <p class="uk-text-meta">A partir del 1° de abril y hasta la fecha del congreso: $930.00 MXN</p>
                    </div>

                    <div class="uk-margin-medium">
                        <a href="{{ route('site.login') }}" class="uk-button uk-button-primary uk-box-shadow-hover-large">Apartar mi lugar</a>
                    </div>
                    
                </article>
            </div>

            <div class="uk-width-2-5@m">
                <article class="uk-card uk-card-default uk-card-body uk-box-shadow-hover-large uk-text-center uk-flex uk-flex-column uk-flex-between">

                    <div>
                        <h3 class="text-secondary">$1,130.00 MXN</h3>
                        <h5>Profesionistas</h5>

                        <p class="uk-text-meta uk-margin-medium-top">A partir del 1° de abril y hasta la fecha del congreso: $1,680.00 MXN</p>
                    </div>

                    <div class="uk-margin-medium">
                        <a href="{{ route('site.login') }}" class="uk-button uk-button-primary uk-box-shadow-hover-large">Apartar mi lugar</a>
                    </div>
                    
                </article>
            </div>

        </div>

        <h2 style="padding-top: 50px;">Costos de talleres</h2>
        <hr class="uk-divider-small">

        <div class="uk-flex uk-flex-center uk-margin-large">

            <article class="uk-card uk-card-default uk-card-body uk-box-shadow-hover-large uk-text-center uk-width-2-5@m">

                <h3 class="text-secondary">$500.00 MXN</h3>
                <h5>Estudiantes / Profesionistas</h5>
                
            </article>

        </div>

    </section>

    <section class="gradient-primary-left uk-margin-large uk-light" style="padding-top:80px; padding-bottom: 70px;">

        <div class="uk-container uk-margin-large uk-panel">

            <img data-src="{{ asset('images/paypal.png') }}" class="uk-align-right@s uk-align-center uk-margin-remove-adjacent" uk-img>

            <h2>Métodos de pago</h2>
            <hr class="uk-divider">

            <p>Dentro de los métodos de pago disponibles están: <b>depósito bancario</b>, <b>transferencia electrónica</b> o pago con <b>Paypal</b> </p>

            <p>¿Deseas realizar el pago para asegurar tu asistencia al congreso? Escríbenos a <strong>finanzas.coniitch@uaem.mx</strong>.</p>

        </div>

    </section>

    <section class="uk-container uk-margin-large" style="padding-top: 40px; padding-bottom: 80px;" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 400">

        <h3>Información de pagos</h3>
        <hr class="uk-divider-small">

        <h4>Pagos de inscripción al congreso</h4>

        <ul class="uk-margin">
            <li class="uk-margin">
                <strong>Depósito bancario:</strong> en cualquier Banco Santander de la República Mexicana, a nombre de <strong>UAEM-CENTRO DE INVESTIGACIÓN TRANSDISCIPLINAR EN PSIC</strong>, 
                número de cuenta 65504253241.
            </li>
            <li class="uk-margin">
                <strong>Transferencia electrónica (banca en línea, aplicaciones móviles sin importar el banco)</strong> a nombre de <strong>UAEM-CENTRO DE INVESTIGACIÓN TRANSDISCIPLINAR  EN PSIC, 
                CLABE 014540655042532411</strong>.
            </li>
            <li>
                <strong>Pagos de extranjeros:</strong> realizar depósito o transferencia bancaria internacional en su lugar de origen, indicando los siguientes datos:
                <ul>
                    <li>
                        I. Banco beneficiario: <strong>BMSXMXMMXXX BANCO SANTANDER (MÉXICO) S.A.</strong>
                    </li>
                    <li>
                        II. Nombre y número de cuenta del beneficiario: <strong>UAEM-CENTRO DE INVESTIGACIÓN TRANSDISCIPLINAR EN PSIC, CLABE 014540655042532411</strong>
                    </li>
                </ul>
            </li>
        </ul>

        <h4>Consideraciones</h4>

        <ul class="uk-margin">
            <li>
                <strong>Facturación:</strong> si requiere factura, deberá solicitarlo al correo <strong>finanzas.coniitch@uaem.mx</strong> enviando su nombre completo y su comprobante de pago escaneado.
            </li>
            <li>
                <strong>Dudas: </strong> si tiene dudas respecto a su facturación, envíe un correo electrónico a <strong>finanzas.coniitch@uaem.mx</strong> y con gusto le responderemos.
            </li>
        </ul>

    </section>

@endsection