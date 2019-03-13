@extends('layouts.app')

@section('title', 'Documentos del congreso')

@section('hero', 'Documentos')

@section('content')

    <section class="uk-container uk-margin">

        <h3>Documentos del congreso</h3>
        
        <p>
            Aquí podrás encontrar documentos tales como: <b>Gafete</b> (una vez realizado el pago de inscripción al congreso), <b>constancias de asistencia</b>, <b>reconocimientos</b> 
            (por participación en la exposición de carteles), entre otros.
        </p>

        <hr class="uk-divider-small">

        <div class="uk-grid uk-grid-match uk-child-width-1-4@xl uk-child-width-1-3@l uk-child-width-1-2@s uk-margin-large-top" uk-grid uk-height-match="target: > div > .uk-card">

            @foreach ($documents as $document)
                <div>
                    <div class="uk-card uk-card-default uk-card-body uk-box-shadow-small uk-box-shadow-hover-large">

                        <h5>{{ $document->title }}</h5>

                        <p class="uk-text-small">{{ $document->description }}</p>

                        <div class="uk-flex uk-flex-between uk-margin-medium-top">

                            <div>
                                <span role="note" class="uk-text-danger" uk-icon="file-pdf"></span>
                            </div>

                            <ul class="uk-iconnav">
                                <li>
                                    <a href="{{ Storage::url($document->file) }}" download="{{ $document->title }}" uk-icon="download" uk-tooltip="Descargar"></a>
                                </li>
                                <li>
                                    <a href="{{ Storage::url($document->file) }}" target="_blank" uk-icon="forward" uk-tooltip="Abrir en nueva pestaña"></a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        @if ( count($documents) == 0 )
            <div class="uk-text-center">
                <h5>Aún no dispones de documentos ...</h5>
            </div>
        @endif

    </section>

@endsection

@push('js')
    <script src="{{ mix('js/app.js') }}" defer></script>
@endpush