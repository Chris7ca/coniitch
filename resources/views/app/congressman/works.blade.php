@extends('layouts.app')

@section('title', 'Trabajos')

@section('hero', 'Información sobre el trabajo')

@section('content')
    
    <section class="uk-container uk-margin">

        <h2>{{ $work->title }}</h2>

        <div class="uk-grid uk-margin" uk-grid>

            <div class="uk-width-expand@m">
                <div>

                    <ul class="uk-subnav uk-subnav-divider uk-margin-large-bottom">
                        <li><span>{{ ($work->type == 'Banner') ? 'Cartel' : 'Oral' }}</span></li>
                        <li><span>{{ ($work->axis == 'Research') ? 'Investigación' : 'Teórico' }}</span></li>
                        <li><span>{{ ($work->theme == 'Transdiscipline') ? 'Transdisciplina' : 'Salud y sociedad' }}</span></li>
                        <li><span>Registrado {{ $work->created_at->diffForHumans() }}</span></li>
                    </ul>

                    @if ( Auth::user()->isRevisor() )

                        <h6 class="text-secondary">Autores</h6>

                        <table class="uk-table uk-table-middle uk-table-divider">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Adscripción</th>
                                    <th>Correo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($work->coauthors as $coauthor)
                                    <tr>
                                        <td>
                                            {{ $coauthor->full_name }}
                                            @if ( $coauthor->is_first_author )
                                                <br> <span class="uk-label uk-text-small">Autor principal</span>
                                            @endif
                                        </td>
                                        <td>{{ $coauthor->adscription }}</td>
                                        <td>{{ $coauthor->email }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        {{ $work->registered_user->first_name . ' ' . $work->registered_user->personal_profile->second_name . ' ' . $work->registered_user->last_name . ' ' . $work->registered_user->personal_profile->second_last_name }}
                                    </td>
                                    <td>{{ $work->adscription }}</td>
                                    <td>{{ $work->registered_user->email }}</td>
                                </tr>
                            </tbody>
                        </table>

                    @endif

                    <h6 class="text-secondary">Resumen del trabajo</h6>

                    <div class="uk-margin-medium">
                        {!! $work->content !!}
                    </div>

                </div>
            </div>

        </div>   
        
    </section>

@endsection

@push('js')
    <script src="{{ mix('js/app.js') }}" defer></script>
@endpush