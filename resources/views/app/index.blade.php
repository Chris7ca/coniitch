@extends('layouts.app')

@section('title', 'Incio')

@section('hero', 'Bienvenido')

@section('content')
    
    <section class="uk-container uk-margin uk-text-center">
        
        <h6>Solo faltan</h6>

        <div class="uk-grid-small uk-child-width-1-4 uk-text-primary" uk-grid uk-countdown="date: 2019-05-22T00:00:00+00:00">
            <div>
                <div class="uk-card uk-card-body card-bordered uk-flex uk-flex-column uk-flex-middle">
                    <div class="uk-countdown-number uk-countdown-days"></div>
                    <div class="uk-countdown-label uk-margin-small">Días</div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-body card-bordered uk-flex uk-flex-column uk-flex-middle">
                    <div class="uk-countdown-number uk-countdown-hours"></div>
                    <div class="uk-countdown-label uk-margin-small">Horas</div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-body card-bordered uk-flex uk-flex-column uk-flex-middle">
                    <div class="uk-countdown-number uk-countdown-minutes"></div>
                    <div class="uk-countdown-label uk-margin-small">Minutos</div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-body card-bordered uk-flex uk-flex-column uk-flex-middle">
                    <div class="uk-countdown-number uk-countdown-seconds"></div>
                    <div class="uk-countdown-label uk-margin-small">Segundos</div>
                </div>
            </div>
        </div>
        

        <h3>3<sup>er</sup> Congreso Internacional de Investigación Transdisciplinar en Ciencias Humanas</h3>
        <hr class="uk-divider-small">
        <h4 class="uk-margin-remove uk-text-muted">Sociedad, Salud y Transdisciplina</h4>

    </section>

@endsection

@push('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush