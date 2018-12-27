@extends('layouts.auth')

@section('title', 'Registro')

@section('content')

    <h3>¡Regístrate!</h3>
    <p>No te pierdas esta gran oportunidad</p>

    <form method="POST" action="{{ route('signup') }}" class="uk-form-stacked uk-margin-medium">

        @csrf

        <div class="uk-margin-medium">
            <label class="uk-form-label">Nombre completo</label>
            <input type="text" class="uk-input" name="name" value="{{ old('name') }}" required autofocus placeholder="Campo requerido...">
        </div>

        <div class="uk-margin-medium">
            <label class="uk-form-label">Correo electrónico</label>
            <input type="email" class="uk-input" name="email" value="{{ old('email') }}" required placeholder="Campo requerido...">
        </div>

        <div class="uk-margin-medium">
            <label class="uk-form-label">Contraseña</label>
            <input type="password" class="uk-input" name="password" required placeholder="*******************">
        </div>

        <div class="uk-margin-medium">
            <label class="uk-form-label">Repíta su contraseña</label>
            <input type="password" class="uk-input" name="password_confirmation" required placeholder="*******************">
        </div>

        <div class="uk-margin-medium">
            <label class="uk-text-meta light-text">
                <input class="uk-checkbox" type="checkbox" required>
                Al hacer clic en "Regístrarme", acepto los <a href="terminos.html" class="text-secondary">Términos y condiciones</a> y la 
                <a href="privacidad.html" class="text-secondary">Política de privacidad</a>.
            </label>
        </div>

        <div class="uk-margin-medium">
            <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large">Regístrarme</button>
        </div>

    </form>

@endsection
