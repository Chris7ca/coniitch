@extends('layouts.app')

@section('title', 'Incio')

@section('subtitle', 'Bienvenido')

@section('content')
    
    <section class="uk-container uk-margin">
        <h4>Lorem ispum dolor is atem</h4>
    </section>

@endsection

@push('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush