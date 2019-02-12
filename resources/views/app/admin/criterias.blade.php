@extends('layouts.app')

@section('title', 'Criterios de evaluación')

@section('hero', 'Criterios')

@section('content')
    
    <section class="uk-container uk-margin-large-bottom">

        <div class="uk-grid" uk-grid>

            <div class="uk-width-2-5@m">
                <div>

                    <div class="uk-card uk-card-body uk-card-default uk-box-shadow-small">

                        <h6>Formualrio para crear o editar criterios de evaluación</h6>

                        <criteria></criteria>

                    </div>

                </div>
            </div>

            <div class="uk-width-expand@m uk-flex-first@m">
                <div>

                    <h3>Crietrios de evaluación</h3>
                    <hr class="uk-divider-small">

                    <criterias></criterias>

                </div>
            </div>

        </div>

    </section>

@endsection

@push('js')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endpush