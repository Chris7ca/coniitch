@extends('layouts.app')

@section('title', 'Asistencia al congreso')

@section('hero', 'Asistencia')

@section('content')
    
    <section class="uk-container uk-margin">

        <h3>Asistencia al congreso</h3>

        <attendances></attendances>

    </section>

@endsection

@push('js')
    <script src="{{ mix('js/staff.js') }}" defer></script>
@endpush