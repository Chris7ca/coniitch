@extends('layouts.app')

@section('title', 'Editar perfil')

@section('hero', 'Mi perfil')

@section('content')

    <section class="uk-container uk-margin-large-bottom">

        <div class="uk-grid uk-grid-small" uk-grid>

            <div class="uk-width-1-4@m">

                <avatar class="uk-margin-large-bottom" :user="{{ json_encode(Auth::user()) }}"></avatar>

            </div>

            <div class="uk-width-expand@m">

                <h2>Información Personal</h2>

                <hr class="uk-divider-small">

                @if (session('doesntHaveProfiles'))
                    <p>{{ session('doesntHaveProfiles') }}</p>
                @else
                    <p>En cualquier momento puedes editar tu información personal.</p>
                @endif

                <ul class="switcher-icons uk-flex uk-flex-middle uk-margin-medium" uk-switcher style="padding:0;">

                    <li>
                        <a role="button" class="uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-h6 uk-link-reset"> 
                            <span class="uk-margin-small" uk-icon="icon: user; ratio: 1.3"></span> Personal
                        </a>
                    </li>

                    @if ( Auth::user()->isCongressman() )
                        
                        <li>
                            <a role="button" class="uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-h6 uk-link-reset"> 
                                <span class="uk-margin-small" uk-icon="graduation-cap"></span> Académico
                            </a>
                        </li>

                        <li>
                            <a role="button" class="uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-h6 uk-link-reset"> 
                                <span class="uk-margin-small" uk-icon="briefcase"></span> Profesional
                            </a>
                        </li>

                        <li>
                            <a role="button" class="uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-h6 uk-link-reset">
                                <span class="uk-margin-small" uk-icon="credit-card"></span> Facturación
                            </a>
                        </li>

                        <li>
                            <a role="button" class="uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-h6 uk-link-reset"> 
                                <span class="uk-margin-small" uk-icon="emergency"></span>  Emergencias
                            </a>
                        </li>

                    @endif

                    <li>
                        <a role="button" class="uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-h6 uk-link-reset"> 
                            <span class="uk-margin-small" uk-icon="fingerprint"></span>  Credenciales
                        </a>
                    </li>
                    
                </ul>

                <ul class="uk-switcher uk-margin-medium-top">

                    <li>
                        <personal-profile></personal-profile>
                    </li>

                    @if ( Auth::user()->isCongressman() )
                    
                        <li>
                            <academic-profile></academic-profile>
                        </li>
    
                        <li>
                            <professional-profile></professional-profile>
                        </li>

                        <li>
                            <invoicing-data></invoicing-data>
                        </li>
    
                        <li>
                            <emergency-contact></emergency-contact>
                        </li>

                    @endif

                    <li>
                        <password></password>
                    </li>

                </ul>

            </div>

        </div>

    </section>

@endsection

@push('js')
    <script src="{{ asset('js/profiles.js') }}" defer></script>
@endpush