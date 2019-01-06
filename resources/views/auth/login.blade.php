@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')

    <h3>Inicia Sesión</h3>
    <p>Nunca compartas tus credenciales de acceso</p>

    @if ($errors->all())
    
        <div class="uk-alert-danger uk-animation-shake uk-margin" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <h5>¡Espera!</h5>
            <ul class="uk-list">
                @foreach ( $errors->all() as $message )
                    <li><small>{{ $message }}</small></li>
                @endforeach
            </ul>
        </div>

    @endif

    <form method="POST" action="{{ route('to.access') }}" class="uk-form-stacked uk-margin-medium">

        @csrf

        <div class="uk-margin-medium">
            <label class="uk-form-label">Correo electrónico</label>
            <input type="email" class="uk-input" name="email" value="{{ old('email') }}" autofocus required placeholder="Campo requerido...">
        </div>

        <div class="uk-margin-medium">
            <label class="uk-form-label">Contraseña</label>
            <input type="password" class="uk-input" name="password" required placeholder="*******************">
        </div>

        <div class="uk-margin-medium-top">
            <label><input type="checkbox" class="uk-checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Recordar contraseña</label>
        </div>

        <div class="uk-margin-small">
            <p class="uk-text-meta"><a href="{{ route('password.request') }}" class="text-secondary">¿Olvidaste tu contraseña?</a></p>
        </div>

        <div class="uk-text-center uk-margin-medium">
            <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large">Acceder</button>
        </div>

    </form>

    <hr class="uk-divider-icon">

    <div class="uk-text-center">
        <a class="button-google uk-box-shadow-hover-medium" href="{{ route('social.auth', 'google') }}">
            <span class="uk-margin-small-right uk-icon-image" style="background-image: url('/svg/google-icon.svg');" uk-icon></span> 
            Accede con Google
        </a>
    </div>

    <div class="uk-text-center uk-margin">
        <a class="button-facebook uk-box-shadow-hover-medium" href="{{ route('social.auth', 'facebook') }}">
            <span class="uk-margin-small-right" uk-icon="facebook"></span> 
            Accede con Facebook
        </a>
    </div>

@endsection
