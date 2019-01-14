@extends('layouts.app')

@section('title', 'Patrocinadores')

@section('hero', 'Patrocinadores')

@section('content')

    <section class="uk-container uk-margin-large-bottom">

        <h3>Nuestros patrocinadores</h3>
        <hr class="uk-divider-small">

        <sponsors></sponsors>

    </section>

@endsection

@section('modals')

    <modal-sponsor></modal-sponsor>

@endsection

@push('js')
    <script src="{{ asset('editor/ckeditor.js') }}" defer></script>
    <script src="{{ asset('js/sponsors.js') }}" defer></script>
@endpush