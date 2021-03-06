@extends('layouts.error')

@section('title', __('Page Not Found'))

@section('error')
    
    <h1 class="uk-heading-hero">404</h1>
    <hr class="uk-divider-small">

    <p class="uk-margin-medium">{{ __('Sorry, the page you are looking for could not be found.') }}</p>

    @auth
        <a href="{{ route('app.index') }}" class="uk-button uk-button-default uk-margin-medium uk-box-shadow-hover-large">Regresar</a>
    @endauth

    @guest
        <a href="{{ route('site.index') }}" class="uk-button uk-button-default uk-margin-medium uk-box-shadow-hover-large">Regresar</a>
    @endguest

@endsection