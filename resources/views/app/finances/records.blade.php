@extends('layouts.app')

@section('title', 'Registros')

@section('hero', 'Registros')

@section('content')

    <section class="uk-container uk-margin">

        <h3>Registros de cogresistas</h3>

        <records></records>
        
    </section>

@endsection

@section('modals')
    <modal-profile></modal-profile>
@endsection

@push('js')
    <script src="{{ mix('js/finances.js') }}" defer></script>
@endpush