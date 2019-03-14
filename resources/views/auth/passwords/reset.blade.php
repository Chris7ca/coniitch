@extends('layouts.auth')

@section('title', 'Reestablecer Contraseña')

@section('content')

    <h3>Restablece tu contraseña</h3>
    <p>Cambia tu contraseña para que vuelvas a iniciar sesión en la plataforma</p>

    <form id="form-auth" method="POST" action="{{ route('password.update') }}" class="uk-form-stacked uk-margin-medium">

        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="uk-margin-medium">
            <label class="uk-form-label">Correo electrónico</label>
            <input type="email" class="uk-input" name="email" value="{{ $email ?? old('email') }}" required autofocus placeholder="Campo requerido...">
            @if ($errors->has('email'))
                <span class="uk-text-danger uk-text-bold" role="alert">
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
            <label class="uk-form-label">Repíta su contraseña</label>
            <div class="uk-inline uk-width-1-1">
                <span class="uk-form-icon uk-form-icon-flip uk-text-warning" uk-icon="icon: warning" v-if="passwordConfirmationIsValid == false"></span>
                <span class="uk-form-icon uk-form-icon-flip uk-text-primary" uk-icon="icon: check" v-if="passwordConfirmationIsValid == true"></span>
                <input type="password" class="uk-input" name="password_confirmation" v-model="passwordConfirmation" required placeholder="*******************">
            </div>
            <span class="uk-text-warning uk-text-bold" v-if="passwordConfirmationIsValid == false">
                <small>Las contraseñas no coinciden</small>
            </span>
        </div>

        <div class="uk-margin-medium">
            <button type="submit" class="uk-button uk-button-primary uk-box-shadow-hover-large">Cambiar contraseña</button>
        </div>

    </form>

@endsection

@push('js')
    <script src="{{ asset('js/auth.js') }}" defer></script>
@endpush