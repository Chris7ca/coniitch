@extends('layouts.site')

@section('title', 'Inicio')

@section('content')

    <main class="uk-background-top-right uk-background-cover" data-src="{{ asset('images/microphone.jpeg') }}" uk-img>
            
        <div class="gradient-background-top uk-position-relative" uk-height-viewport>
            
            @include('layouts.headersite')
            
            <article class="uk-container uk-text-center uk-light uk-position-center uk-margin" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 500">
                
                <h1>3<sup>er</sup> Congreso Internacional de Investigación Transdisciplinar en Ciencias Humanas</h1>
                
                <h2 class="uk-margin-remove">Sociedad, Salud y Transdisciplina</h2>

                <a href="#invitations" class="uk-button uk-margin" uk-scroll>
                    <span class="uk-margin-small-right" uk-icon="icon: play-circle; ratio: 2"></span> Ver invitaciones
                </a>
                
            </article>
            
        </div>
        
    </main>

    <section class="uk-container uk-flex uk-flex-center to-top" uk-scrollspy="target: > div; cls:uk-animation-fade; delay: 500">
        
        <div class="uk-card uk-card-default uk-card-body uk-box-shadow-large">

            <h3 class="uk-margin-large uk-text-center">¡Ya solo faltan!</h3>

            <div class="uk-grid-small uk-child-width-auto uk-flex-center text-secondary" uk-grid uk-countdown="date: 2019-05-22T02:50:18+00:00">
                <div>
                    <div class="uk-countdown-number uk-countdown-days uk-text-center"></div>
                    <div class="uk-countdown-label uk-margin-small uk-text-center">Días</div>
                </div>
                <div class="uk-countdown-separator">:</div>
                <div>
                    <div class="uk-countdown-number uk-countdown-hours uk-text-center"></div>
                    <div class="uk-countdown-label uk-margin-small uk-text-center">Horas</div>
                </div>
                <div class="uk-countdown-separator">:</div>
                <div>
                    <div class="uk-countdown-number uk-countdown-minutes uk-text-center"></div>
                    <div class="uk-countdown-label uk-margin-small uk-text-center">Minutos</div>
                </div>
                <div class="uk-countdown-separator uk-visible@s">:</div>
                <div class="uk-visible@s">
                    <div class="uk-countdown-number uk-countdown-seconds uk-text-center"></div>
                    <div class="uk-countdown-label uk-margin-small uk-text-center">Segundos</div>
                </div>
            </div>

            <h4 class="uk-text-center">Este 22, 23 y 24 de mayo de 2019</h4>

        </div>

    </section>

    <section class="uk-container uk-text-center" uk-scrollspy="target: > *; cls:uk-animation-slide-bottom; delay: 400">

        <h3 class="uk-text-muted">Del comité científico</h3>

        <hr class="uk-divider-small">

        <p class="uk-margin-large-bottom">“El Centro de Investigación Transdisciplinar en Psicología (CITPsi) se ha propuesto la misión de contribuir a la investigación transdisciplinar 
        desde el abordaje de temas de mayor repercusión social. Para ello ha generado diversos espacios académicos en los cuales  destaca su congreso de investigación transdisciplinar, 
        cuya primera edición tuvo lugar en Mayo del 2015. En este congreso se identificó la situación actual de la teoría, la investigación y la  práctica de la transdisciplinariedad en 
        los campos o líneas de estudio propias de este centro, estableciéndose éste como un espacio con una visión de intercambio y desarrollo permanentes.”</p>

    </section>

    <section id="invitations" class="uk-margin-large uk-light gradient-primary-left" style="padding-bottom: 100px; padding-top: 100px;">

        <div class="uk-container">

            <h3 class="uk-text-center">Invitaciones</h3>

            <div class="uk-grid uk-grid-match uk-child-width-1-3@xl uk-child-width-1-2@s uk-flex-center" uk-grid>

                <div>
                    <div class="uk-card uk-box-shadow-small uk-box-shadow-hover-xlarge video-invitacion">
                        <iframe src="https://player.vimeo.com/video/319067714" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen uk-video="autoplay: false"></iframe>
                    </div>
                </div>

                <div>
                    <div class="uk-card uk-box-shadow-small uk-box-shadow-hover-xlarge video-invitacion">
                        <iframe src="https://player.vimeo.com/video/319067795" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen uk-video="autoplay: false"></iframe>
                    </div>
                </div>

                <div>
                    <div class="uk-card uk-box-shadow-small uk-box-shadow-hover-xlarge video-invitacion">
                        <iframe src="https://player.vimeo.com/video/322339418" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen uk-video="autoplay: false"></iframe>
                    </div>
                </div>

                <div>
                    <div class="uk-card uk-box-shadow-small uk-box-shadow-hover-xlarge video-invitacion">
                        <iframe src="https://player.vimeo.com/video/319067862" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen uk-video="autoplay: false"></iframe>
                    </div>
                </div>

                <div>
                    <div class="uk-card uk-box-shadow-small uk-box-shadow-hover-xlarge video-invitacion">
                        <iframe src="https://player.vimeo.com/video/321310584" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen uk-video="autoplay: false"></iframe>
                    </div>
                </div>

                <div>
                    <div class="uk-card uk-box-shadow-small uk-box-shadow-hover-xlarge video-invitacion">
                        <iframe src="https://player.vimeo.com/video/321136394" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen uk-video="autoplay: false"></iframe>
                    </div>
                </div>
                
            </div>

        </div>

    </section>

    <section class="uk-container uk-margin-large" style="padding-bottom: 80px;">

        <h2>Histórico</h2>
        <hr class="uk-divider-small">

        <div class="uk-grid uk-grid-match uk-child-width-1-2@m uk-margin-large" uk-grid>
            
            <div uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">
                <div class="uk-card uk-box-shadow-large uk-background-cover min-height" data-src="{{ asset('images/expositions.JPG') }}" uk-img>
                    <div class="filter uk-width-1-1 uk-height-1-1"></div>
                </div>
            </div>

            <div uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">
                <article class="uk-padding uk-padding-remove-horizontal">
                    <h4 class="text-secondary">1<sup>er</sup> Congreso</h4>

                    <hr class="uk-divider-small">

                    <h5 class="uk-text-muted uk-margin-remove">Psicología y Transdisciplinariedad</h5>

                    <p class="uk-margin-medium-top">El 1<sup>er</sup> Congreso llamado “Psicología y Transdisciplinariedad” fue un éxito académico que permitió identificar diversas áreas de oportunidad en el enfoque de 
                    nuestra investigación y ayudó a consolidar la voluntad de seguir construyendo una visión más transdisciplinar de nuestros objetos de estudio. La evolución natural del 
                    congreso implicó la transformación de su nombre a un horizonte que hace necesaria su internacionalización, así como la extensión de su alcance hacia las Ciencias Humanas 
                    en general, además de una reestructuración de sus ejes temáticos tomando como base los objetivos para el desarrollo sostenible preconizados por la ONU estableciéndose 5 
                    ejes temáticos.</p>
                </article>
            </div>

        </div>

        <div class="uk-grid uk-grid-large uk-grid-match uk-child-width-1-2@m uk-margin-large" uk-grid>
            
            <div uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">
                <div class="uk-card uk-box-shadow-large uk-background-cover min-height" data-src="{{ asset('images/conference.jpg') }}" uk-img>
                    <div class="filter uk-width-1-1 uk-height-1-1"></div>
                </div>
            </div>

            <div class="uk-flex-first@m" uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">
                <article class="uk-padding uk-padding-remove-horizontal">
                    <h4 class="text-secondary">2<sup>do</sup> Congreso</h4>

                    <hr class="uk-divider-small">

                    <h5 class="uk-text-muted uk-margin-remove">La Investigación Transdisciplinar ante los Desafíos de la Sociedad Contemporánea</h5>

                    <p class="uk-margin-medium-top">El objetivo general de este congreso fue el de promover y fortalecer este espacio académico para el intercambio entre investigadores, 
                    estudiantes y profesionales interesados en la investigación transdisciplinar de estos temas prioritarios para el CITPsi, consolidando su desarrollo y aporte a los 
                    grandes problemas de nuestra sociedad actual.</p>
                    <p>El congreso contó con la participación de los mejores investigadores nacionales y con prestigiosos expertos internacionales en estos temas. También fue un espacio muy 
                    propicio para el intercambio de saberes desde distintas disciplinas, enfatizando la actualización y formación en el tema.</p>
                </article>
            </div>

        </div>

        <div class="uk-grid uk-grid-large uk-grid-match uk-child-width-1-2@m uk-margin-large" uk-grid>
            
            <div uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">
                <div class="uk-card uk-box-shadow-large uk-background-cover min-height" data-src="{{ asset('images/microphone.jpeg') }}" uk-img>
                    <div class="filter uk-width-1-1 uk-height-1-1"></div>
                </div>
            </div>

            <div uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">
                <article class="uk-padding uk-padding-remove-horizontal">
                    <h4 class="text-secondary">3<sup>er</sup> Congreso</h4>

                    <hr class="uk-divider-small">

                    <h5 class="uk-text-muted uk-margin-remove">Salud, Sociedad y Transdisciplina</h5>

                    <p class="uk-margin-medium-top">Nuestro interés es que los congresos subsecuentes tengan el objetivo de replantearse problemáticas de actualidad en donde los científicos 
                    y participantes puedan enfocar su reflexión para analizar las diferentes aristas de un problema general y buscar eventuales soluciones a través de la reflexión 
                    transdisciplinar. De esta forma nuestro “3<sup>er</sup> Congreso Internacional de Investigación en Ciencias Humanas” estará enfocado a la temática de la “Salud, Sociedad y 
                    Transdisciplina”, en donde esperamos que los investigadores participantes que tengan trabajos en alguna de estas temáticas, traten de replantearse siempre la importancia 
                    de la transdisciplina en sus temas de investigación y puedan presentarnos sus avances para discutir sobre sus planteamientos.</p>
                    <p class="uk-text-bold">¡No te pierdas esta oportunidad! Regístrate y aparta tu lugar... <a href="{{ route('site.register') }}" class="text-secondary" role="link">Click aquí 
                    <span class="uk-margin-left-small" uk-icon="icon: arrow-left; ratio: 1.2"></span></a></p>
                </article>
            </div>

        </div>

    </section>

    <section class="gradient-primary-left uk-padding-large uk-margin-large">
        
        <div class="uk-container uk-text-center">

            <h2 class="text-white" uk-scrollspy="cls:uk-animation-fade; delay: 200">Ejes del Congreso</h2>

            <div class="uk-grid uk-grid-large uk-grid-match uk-child-width-1-3@m uk-flex-center uk-margin-large" uk-grid uk-scrollspy="target: > div; cls:uk-animation-slide-top-medium; delay: 200">

                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <article class="uk-text-center">
                            <span uk-icon="icon: research; ratio: 2.5"></span>
                            <h5>Investigación</h5>
                            <p>Trabajos que abordan diferentes problemáticas relacionadas a la salud y sociedad que presenten datos empíricos y que tengan una articulación con temas que involucren la realidad 
                            social desde una aproximación inter, multi o transdisciplinar</p>
                        </article>
                    </div>
                </div>

                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <article class="uk-text-center">
                            <span uk-icon="icon: dialog; ratio: 2.5"></span>
                            <h5>Teóricos</h5>
                            <p>Reflexiones, experiencias metodológicas y empíricas relacionadas con la transdisciplina</p>
                        </article>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <section class="uk-container uk-margin-large">
        
        <div class="uk-grid uk-grid-medium uk-flex-middle" uk-grid style="padding-top: 50px;">
        
            <div class="uk-width-1-3@m">
                <div uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">

                    <h3>Coorganizadores</h3>
                    <hr class="uk-divider-small">

                    <p>Instituciones involucradas en la organización del 3<sup>er</sup> Congreso Internacional de Investigación Transdisciplinar en Ciencias Humanas</p>

                </div>
            </div>

            <div class="uk-width-expand@m">
                <div class="uk-grid-large uk-flex-center uk-flex-middle" uk-grid uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 400">

                        <div>
                            <a href="https://www.uaem.mx/" target="_blank" role="link">
                                <img data-src="{{ asset('logos/uaem.png') }}" width="100" alt="Universidad Autónoma del Estado de Morelos" uk-img>
                            </a>
                        </div>    
                        
                        <div>
                            <a href="https://www.cienciascognitivas.org/" target="_blank" role="link">
                                <img data-src="{{ asset('logos/cincco.png') }}" width="120" alt="Centro de Investigación en Ciencias Cognitivas" uk-img>
                            </a>
                        </div>    
                        
                        <div>
                            <a href="https://www.uaem.mx/organizacion-institucional/unidades-academicas/escuelas/estudios-superiores-del-jicarero" target="_blank" role="link">
                                <img data-src="{{ asset('logos/jicarero.png') }}" width="110" alt="Escuela de Estudios Superiores del Jicarero" uk-img>
                            </a>
                        </div>  
    
                        <div>
                            <a href="https://www.uaem.mx/organizacion-institucional/unidades-academicas/facultades/psicologia" target="_blank" role="link">
                                <img data-src="{{ asset('logos/fapsy.png') }}" width="80" alt="Facultad de Psicología UAEM" uk-img>
                            </a>
                        </div>  
    
                        <div>
                            <a role="banner">
                                <img data-src="{{ asset('logos/tapalcingo.png') }}" width="80" alt="Escuela de Estudios Superiores de  Tepalcingo" uk-img>
                            </a>
                        </div>  
    
                        <div>
                            <a role="banner">
                                <img data-src="{{ asset('logos/miacatlan.png') }}" width="120" alt="Escuela de Estudios Superiores de Miacatlán" uk-img>
                            </a>
                        </div>  
    
                </div>
            </div>

        </div>

        <div class="uk-grid uk-grid-large uk-flex-middle uk-margin-large" uk-grid style="padding-top: 100px;">

            <div class="uk-width-1-3@m uk-flex-last@m">
                <div class="uk-text-right" uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">

                    <h3>Patrocinadores</h3>
                    <hr class="uk-divider-small">

                    <p>Nuestros patrocinadores del congreso</p>

                </div>
            </div>

            <div class="uk-width-expand@m">
                <div class="uk-grid-medium uk-flex-around uk-flex-middle" uk-grid uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 400">

                    @foreach ($sponsors as $sponsor)
                        <div>

                            @if ( $sponsor->image->url )
                                <a href="{{ $sponsor->image->url }}" target="_blank" role="link">
                                    <img data-src="{{ Storage::url($sponsor->image->file) }}" width="{{ $sponsor->image->width }}" alt="{{ $sponsor->display_name }}" uk-img>
                                </a>
                            @else
                                <a role="button">
                                    <img data-src="{{ Storage::url($sponsor->image->file) }}" width="{{ $sponsor->image->width }}" alt="{{ $sponsor->display_name }}" uk-img>
                                </a>
                                <div uk-dropdown="mode: click">
                                    {{ $sponsor->description }}
                                </div>
                            @endif
                            
                        </div> 
                    @endforeach

                </div>
            </div>

        </div>

    </section>

@endsection