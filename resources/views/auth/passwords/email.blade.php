@extends('layouts.auth')

@section('title', 'Recuperar Contraseña')

@section('content')

    <h3>Recupera tu contraseña</h3>
    <p>Ingresa tu correo electrónico para que podamos enviarte información sobre cómo acceder nuevamente a la plataforma</p>

    <form method="POST" action="{{ route('password.email') }}" class="uk-form-stacked uk-margin-medium">

        @csrf

        <div class="uk-margin-medium">
            <label class="uk-form-label">Correo electrónico</label>
            <input type="email" class="uk-input" name="email" value="{{ old('email') }}" autofocus required placeholder="Campo requerido...">
        </div>

        <div class="uk-margin-medium">
            <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large">Solicitar contraseña</button>
        </div>

    </form>

@endsection
