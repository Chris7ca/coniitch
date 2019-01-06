@extends('layouts.error')

@section('title', __('Unauthorized'))

@section('error')
    
    <h1 class="uk-heading-hero">403</h1>
    <hr class="uk-divider-small">

    <p class="uk-margin-medium">{{ __('Sorry, you are not authorized to access this page.') }}</p>

    <a href="/" class="uk-button uk-button-default uk-margin-medium uk-box-shadow-hover-large">Regresar</a>


@endsection