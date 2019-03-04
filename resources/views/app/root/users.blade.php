@extends('layouts.app')

@section('title', 'Gestión de usuarios')

@section('hero', 'Usuarios')

@section('content')
    
    <section class="uk-container">

        <div class="uk-grid" uk-grid>

            <div class="uk-width-2-3@m">

                <div>

                    <h3>Gestión de usuarios</h3>
                    <hr class="uk-divider-small">

                    <users></users>   

                </div>

            </div>

            <div class="uk-width-1-3@m">

                <div>

                    <users-statistics class="uk-card uk-card-default uk-card-body uk-box-shadow-small"></users-statistics>

                    <user class="uk-card uk-card-default uk-card-body uk-box-shadow-small uk-margin"></user>
        
                </div>

            </div>

        </div>

    </section>

@endsection

@section('modals')
    
    <modal-profile></modal-profile>
    
    <modal-documents></modal-documents>

    <modal-document></modal-document>

    <modal-qr-code></modal-qr-code>

@endsection

@push('js')
    <script src="{{ asset('js/root.js') }}" defer></script>
@endpush
