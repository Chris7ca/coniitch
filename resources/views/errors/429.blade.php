@extends('layouts.error')

@section('title', __('Too Many Requests'))

@section('error')
    
    <h1 class="uk-heading-hero">429</h1>
    <hr class="uk-divider-small">

    <p class="uk-margin-medium">{{ __('Sorry, you are making too many requests to our servers.') }}</p>

    @auth
        <a href="{{ route('app.index') }}" class="uk-button uk-button-default uk-margin-medium uk-box-shadow-hover-large">Regresar</a>
    @endauth

    @guest
        <a href="{{ route('site.index') }}" class="uk-button uk-button-default uk-margin-medium uk-box-shadow-hover-large">Regresar</a>
    @endguest

@endsection