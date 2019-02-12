@extends('layouts.app')

@section('title', 'Trabajos recibidos')

@section('hero', 'Trabajos')

@section('content')

    <section class="uk-container uk-margin">

        <h3>Gestión de trabajos</h3>

        <works></works>        

    </section>

@endsection

@section('modals')

    <assign-revisors></assign-revisors>

    <modal-reviews></modal-reviews>
    
@endsection

@push('js')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endpush