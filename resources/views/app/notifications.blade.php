@extends('layouts.app')

@section('title', 'Notificaciones')

@section('hero', 'Notificaciones')

@section('content')
    
    <section class="uk-container uk-margin">
        
        <h3>Notificaciones</h3>
        <hr class="uk-divider-small">

        <notifications></notifications>

    </section>

@endsection

@push('js')
    <script src="{{ mix('js/notifications.js') }}" defer></script>
@endpush