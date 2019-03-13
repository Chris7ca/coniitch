@extends('layouts.auth')

@section('title', 'Registro')

@section('content')

    <h3 id="title-auth">¡Regístrate!</h3>
    <p>No te pierdas esta gran oportunidad</p>

    <form id="form-auth" method="POST" action="{{ route('signup') }}" class="uk-form-stacked uk-margin-medium"> 

        @csrf

        <div class="uk-margin-medium">
            <label class="uk-form-label">Nombre</label>
            <input type="text" class="uk-input" name="name" value="{{ old('name') }}" required autofocus placeholder="Primer nombre y primer apellido">
            @if ($errors->has('name'))
                <span class="uk-text-danger uk-text-bold">
                    <small>{{ $errors->first('name') }}</small>
                </span>
            @endif
        </div>

        <div class="uk-margin-medium">
            <label class="uk-form-label">Correo electrónico</label>
            <input type="email" class="uk-input" name="email" value="{{ old('email') }}" required placeholder="ejemplo@dominio.com">
            @if ($errors->has('email'))
                <span class="uk-text-danger uk-text-bold">
                    <small>{{ $errors->first('email') }}</small>
                </span>
            @endif
        </div>

        <div class="uk-margin-medium">
            <label class="uk-form-label">Contraseña</label>
            <div class="uk-inline uk-width-1-1">
                <span class="uk-form-icon uk-form-icon-flip uk-text-warning" uk-icon="icon: warning" v-if="passwordIsValid == false"></span>
                <span class="uk-form-icon uk-form-icon-flip uk-text-primary" uk-icon="icon: check" v-if="passwordIsValid == true"></span>
                <input type="password" class="uk-input" name="password" v-model="password" required placeholder="*******************">
            </div>
            <span class="uk-text-warning uk-text-bold" v-if="passwordIsValid == false">
                <small>La contraseña debe de tener mínimo 8 caracteres, una letra mayúscula, una letra minúscula y un dígito</small>
            </span>
            @if ($errors->has('password'))
                <span class="uk-text-danger uk-text-bold">
                    <small>{{ $errors->first('password') }}</small>
                </span>
            @endif
        </div>

        <div class="uk-margin-medium">
            <label class="uk-text-meta light-text">
                <input class="uk-checkbox" type="checkbox" name="privacy_notice" value="true" required>
                Al hacer clic en "Regístrarme", acepto los <a href="terminos.html" class="text-secondary">Términos y condiciones</a> y la 
                <a href="privacidad.html" class="text-secondary">Política de privacidad</a>.
            </label>
        </div>

        <div class="uk-text-center uk-margin-medium">
            <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large">Regístrarme</button>
        </div>

    </form>
    
    <hr class="uk-divider-icon">

    <div class="uk-text-center">
        <a class="button-google uk-box-shadow-hover-medium" href="{{ route('social.auth', 'google') }}">
            <span class="uk-margin-small-right uk-icon-image" style="background-image: url('/svg/google-icon.svg');" uk-icon></span> 
            Regístrate con Google
        </a>
    </div>

    <div class="uk-text-center uk-margin">
        <a class="button-facebook uk-box-shadow-hover-medium" href="{{ route('social.auth', 'facebook') }}">
            <span class="uk-margin-small-right" uk-icon="facebook"></span> 
            Regístrate con Facebook
        </a>
    </div>

@endsection

@push('js')
    <script src="{{ mix('js/auth.js') }}" defer></script>
@endpush