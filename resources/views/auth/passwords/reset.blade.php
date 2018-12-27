@extends('layouts.app')

@section('title', 'Reestablecer Contraseña')

@section('content')

    <h3>Reestablece tu contraseña</h3>
    <p>Cambia tu contraseña para que vuelvas a iniciar sesión en la plataforma</p>

    <form method="POST" action="{{ route('password.update') }}" class="uk-form-stacked uk-margin-medium">

        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="uk-margin-medium">
            <label class="uk-form-label">Correo electrónico</label>
            <input type="email" class="uk-input" name="email" value="{{ $email ?? old('email') }}" required autofocus placeholder="Campo requerido...">
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
            <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large">Solicitar contraseña</button>
        </div>

    </form>

@endsection
