@extends('layouts.app')

@section('title', 'Actividades del congreso')

@section('hero', 'Actividades')

@section('content')
    
    <section class="uk-container">

        <h3>Gestión de actividades del congreso</h3>
        <hr class="uk-divider-small">

        <div class="uk-grid uk-margin-large-top" uk-grid>

            <div class="uk-width-1-3@m">
                <div class="uk-card uk-card-default uk-card-body uk-box-shadow-small" uk-sticky="bottom: true">

                    <h5>Opciones</h5>

                    <events></events>

                </div>
            </div>

            <div class="uk-width-2-3@m">
                <div>

                    <attendances></attendances>

                </div>
            </div>

        </div>

    </section>

@endsection

@section('modals')

    <modal-event></modal-event>

@endsection

@push('js')
    <script src="{{ mix('js/root.js') }}" defer></script>
@endpush