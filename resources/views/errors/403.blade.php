@extends('layouts.error')

@section('title', __('Forbidden'))

@section('error')
    
    <h1 class="uk-heading-hero">403</h1>
    <hr class="uk-divider-small">

    <p class="uk-margin-medium">{{ __($exception->getMessage() ?: __('Sorry, you are forbidden from accessing this page.')) }}</p>

    @auth
        <a href="{{ route('app.index') }}" class="uk-button uk-button-default uk-margin-medium uk-box-shadow-hover-large">Regresar</a>
    @endauth

    @guest
        <a href="{{ route('site.index') }}" class="uk-button uk-button-default uk-margin-medium uk-box-shadow-hover-large">Regresar</a>
    @endguest

@endsection