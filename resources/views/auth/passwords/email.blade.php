@extends('layouts.auth')

@section('title', 'Recuperar Contraseña')

@section('content')

    <h3>Recupera tu contraseña</h3>
    <p>Ingresa tu correo electrónico para que podamos enviarte información sobre cómo acceder nuevamente a la plataforma</p>

    @if (session('status'))
        <div class="uk-alert-success uk-animation-fade uk-margin" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="uk-form-stacked uk-margin-medium">

        @csrf

        <div class="uk-margin-medium">
            <label class="uk-form-label">Correo electrónico</label>
            <input type="email" class="uk-input" name="email" value="{{ old('email') }}" autofocus required placeholder="Campo requerido...">
            @if ($errors->has('email'))
                <span class="uk-text-danger uk-text-bold" role="alert">
                    <small>{{ $errors->first('email') }}</small>
                </span>
            @endif
        </div>

        <div class="uk-margin-medium">
            <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large">Solicitar contraseña</button>
        </div>

    </form>

@endsection
