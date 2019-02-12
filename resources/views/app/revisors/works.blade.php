@extends('layouts.app')

@section('title', 'Trabajos asignados')

@section('hero', 'Trabajos')

@section('content')
    
    <section class="uk-container uk-margin">

        <h4>Mis trabajos asignados</h4>

        <works :revisor="{{ json_encode(Auth::user()) }}"></works>
        
    </section>

@endsection

@section('modals')
    <modal-evaluation></modal-evaluation>
@endsection

@push('js')
    <script src="{{ asset('js/revisors.js') }}" defer></script>
@endpush