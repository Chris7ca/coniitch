@extends('layouts.app')

@section('title', 'Servicios')

@section('hero', 'Servicios')

@section('content')
    
    <section class="uk-container uk-margin">

        <h3>Productos y servicios</h3>
        <hr class="uk-divider-small">

        <services></services>

    </section>

@endsection

@section('modals')

    <modal-service></modal-service>

    <modal-discount></modal-discount>

@endsection

@push('js')
    <script src="{{ mix('js/finances.js') }}" defer></script>
@endpush