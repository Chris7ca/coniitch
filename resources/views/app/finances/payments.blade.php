@extends('layouts.app')

@section('title', 'Registro de pagos')

@section('hero', 'Pagos')

@section('content')

    <section class="uk-container uk-margin">

        <h3>Registro de pagos</h3>

        <payments class="uk-margin-medium-top"></payments>

    </section>

@endsection

@section('modals')

    <modal-profile></modal-profile>

    <payment-information></payment-information>

@endsection

@push('js')    
    <script src="{{ mix('js/finances.js') }}" defer></script>
@endpush