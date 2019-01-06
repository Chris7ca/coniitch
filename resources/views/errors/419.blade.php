@extends('layouts.error')

@section('title', __('Page Expired'))

@section('error')
    
    <h1 class="uk-heading-hero">419</h1>
    <hr class="uk-divider-small">

    <p class="uk-margin-medium">{{ __('Sorry, your session has expired. Please refresh and try again.') }}</p>

    <a href="/" class="uk-button uk-button-default uk-margin-medium uk-box-shadow-hover-large">Regresar</a>


@endsection