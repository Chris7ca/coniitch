@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')

    <h3>Inicia Sesión</h3>
    <p>Nunca compartas tus credenciales de acceso</p>

    <form method="POST" action="{{ route('to.access') }}" class="uk-form-stacked uk-margin-medium">

        @csrf

        <div class="uk-margin-medium">
            <label class="uk-form-label">Correo electrónico</label>
            <input type="email" class="uk-input" value="{{ old('email') }}" autofocus required placeholder="Campo requerido...">
        </div>

        <div class="uk-margin-medium">
            <label class="uk-form-label">Contraseña</label>
            <input type="password" class="uk-input" required placeholder="*******************">
        </div>

        <div class="uk-margin-medium-top">
            <label><input type="checkbox" class="uk-checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Recordar contraseña</label>
        </div>

        <div class="uk-margin-small">
            <p class="uk-text-meta"><a href="{{ route('password.request') }}" class="text-secondary">¿Olvidaste tu contraseña?</a></p>
        </div>

        <div class="uk-margin-medium">
            <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large">Acceder</button>
        </div>

    </form>

@endsection
