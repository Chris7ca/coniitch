@extends('layouts.app')

@section('title', 'Gestión de roles')

@section('hero', 'Roles')

@section('content')
    
    <section class="uk-container">

        <div class="uk-grid" uk-grid>

            <div class="uk-width-2-3@m">

                <div>
                
                    <h3>Gestión de roles</h3>
                    <hr class="uk-divider-small">

                    <roles></roles>

                </div>

            </div>

            <div class="uk-width-1-3@m">

                <role class="uk-card uk-card-body uk-card-default uk-box-shadow-small"></role>

            </div>

        </div>

    </section>

@endsection

@push('js')
    <script src="{{ asset('js/root.js') }}" defer></script>
@endpush