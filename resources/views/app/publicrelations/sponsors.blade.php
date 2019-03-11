@extends('layouts.app')

@section('title', 'Patrocinadores')

@section('hero', 'Patrocinadores')

@section('content')

    <section class="uk-container uk-margin-large-bottom">

        <section class="uk-container uk-margin-large">
        
            <div class="uk-grid uk-grid-medium uk-flex-middle" uk-grid style="padding-top: 50px;">
            
                <div class="uk-width-1-3@m">
                    <div>
    
                        <h3>Coorganizadores</h3>
                        <hr class="uk-divider-small">
    
                        <p>Instituciones involucradas en la organización del 3<sup>er</sup> Congreso Internacional de Investigación Transdisciplinar en Ciencias Humanas</p>
    
                    </div>
                </div>
    
                <div class="uk-width-expand@m">
                    <div class="uk-grid-large uk-flex-center uk-flex-middle" uk-grid>
    
                            <div>
                                <img data-src="{{ asset('logos/uaem.png') }}" width="100" alt="Universidad Autónoma del Estado de Morelos" uk-img>
                            </div>    
                            
                            <div>
                                <img data-src="{{ asset('logos/cincco.png') }}" width="120" alt="Centro de Investigación en Ciencias Cognitivas" uk-img>
                            </div>    
                            
                            <div>
                                <img data-src="{{ asset('logos/jicarero.png') }}" width="110" alt="Escuela de Estudios Superiores del Jicarero" uk-img>
                            </div>  
        
                            <div>
                                <img data-src="{{ asset('logos/fapsy.png') }}" width="80" alt="Facultad de Psicología UAEM" uk-img>
                            </div>  
        
                            <div>
                                <img data-src="{{ asset('logos/tapalcingo.png') }}" width="80" alt="Escuela de Estudios Superiores de  Tepalcingo" uk-img>
                            </div>  
        
                            <div>
                                <img data-src="{{ asset('logos/miacatlan.png') }}" width="120" alt="Escuela de Estudios Superiores de Miacatlán" uk-img>
                            </div>  
        
                    </div>
                </div>
    
            </div>
    
            <div class="uk-grid uk-grid-large uk-flex-middle uk-margin-large" uk-grid style="padding-top: 100px;">
    
                <div class="uk-width-1-3@m uk-flex-last@m">
                    <div class="uk-text-right">
    
                        <h3>Patrocinadores</h3>
                        <hr class="uk-divider-small">
    
                        <p>Nuestros patrocinadores del congreso</p>
    
                    </div>
                </div>
    
                <div class="uk-width-expand@m">
                    
                    <sponsors></sponsors>
                    
                </div>
    
            </div>
    
        </section>

    </section>

@endsection

@section('modals')

    <modal-sponsor></modal-sponsor>

@endsection

@push('js')
    <script src="{{ asset('editor/ckeditor.js') }}" defer></script>
    <script src="{{ asset('js/sponsors.js') }}" defer></script>
@endpush