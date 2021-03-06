@extends('layouts.site')

@section('title', 'Actividades')

@section('content')
    
    <main class="uk-background-cover" data-src="{{ asset('images/activities.jpg') }}" uk-img>
            
        <div class="gradient-background-top uk-position-relative" uk-height-viewport="offset-bottom: 30">
            
            @include('layouts.headersite')
            
            <article class="uk-container uk-text-center uk-light uk-position-center uk-margin" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 500">
                
                <h1>Actividades del Congreso</h1>
                
            </article>
            
        </div>
        
    </main>

    <section class="uk-container uk-margin-large" style="padding-bottom: 80px; padding-top: 80px;">

        <h2>Actividades</h2>
        <hr class="uk-divider-small">

        <div class="uk-grid uk-grid-match uk-child-width-1-2@m uk-margin-large" uk-grid>
            
            <div uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">
                <div class="uk-card uk-box-shadow-large uk-background-cover min-height" data-src="{{ asset('images/conference.jpg') }}" uk-img>
                    <div class="filter uk-width-1-1 uk-height-1-1"></div>
                </div>
            </div>

            <div class="uk-flex-middle" uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">
                <article class="uk-padding uk-padding-remove-horizontal">

                    <h4 class="text-secondary">Talleres</h4>
                    <hr class="uk-divider-small">

                    <p class="uk-margin-medium-top">También tenemos el interés de que este congreso sea formativo por lo que el día miércoles <b>22 de mayo</b> tendremos un taller que nos ayude 
                    a responder la pregunta de <b>“¿Qué es la Transdisciplina?”</b> Invitamos cordialmente a estudiantes, profesores y público en general a que asistan. Este taller será 
                    impartido por: el <b>Dr. César Mureddu</b>, profesor investigador de la UAM-Xochimilco, experto en la interpretación aplicada de los sistemas complejos, particularmente del 
                    orden social. Otros talleres también serán anunciados en su momento.</p>

                </article>
            </div>

        </div>

        <div class="uk-grid uk-grid-match uk-child-width-1-2@m uk-margin-large" uk-grid>
            
            <div uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">
                <div class="uk-card uk-box-shadow-large uk-background-cover min-height" data-src="{{ asset('images/expositions.JPG') }}" uk-img>
                    <div class="filter uk-width-1-1 uk-height-1-1"></div>
                </div>
            </div>

            <div class="uk-flex-middle uk-flex-first@m" uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">
                <article class="uk-padding uk-padding-remove-horizontal">

                    <h4 class="text-secondary">Exposiciones</h4>
                    <hr class="uk-divider-small">

                    <p class="uk-margin-medium-top">También contaremos con la participación de investigadores nacionales que nos compartirán sus trabajos en simposios y mesas de trabajos libres. 
                    Será un espacio muy propicio para el intercambio de saberes desde distintas disciplinas, enfatizando la actualización y formación en las  temáticas de “Salud, Sociedad y 
                    Transdisciplina”.</p>

                    <p>Además hemos abierto espacios para la divulgación de trabajos libres a través de comunicaciones orales y simposios.</p>

                </article>
            </div>

        </div>

        <div class="uk-grid uk-grid-match uk-child-width-1-2@m uk-margin-large" uk-grid>
            
            <div uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">
                <div class="uk-card uk-box-shadow-large uk-background-cover min-height" data-src="{{ asset('images/microphone.jpeg') }}" uk-img>
                    <div class="filter uk-width-1-1 uk-height-1-1"></div>
                </div>
            </div>

            <div class="uk-flex-middle" uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">
                <article class="uk-padding uk-padding-remove-horizontal">

                    <h4 class="text-secondary">Carteles</h4>
                    <hr class="uk-divider-small">

                    <p class="uk-margin-medium-top">Habrá dos sesiones de exposición y discusión de carteles por grupos temáticos.</p>

                </article>
            </div>

        </div>

        <div class="uk-grid uk-grid-match uk-child-width-1-2@m uk-margin-large" uk-grid>
            
            <div uk-scrollspy="cls:uk-animation-slide-left-medium; delay: 200">
                <div class="uk-card uk-box-shadow-large uk-background-cover min-height" data-src="{{ asset('images/winner.JPG') }}" uk-img>
                    <div class="filter uk-width-1-1 uk-height-1-1"></div>
                </div>
            </div>

            <div class="uk-flex-middle uk-flex-first@m" uk-scrollspy="cls:uk-animation-slide-right-medium; delay: 200">
                <article class="uk-padding uk-padding-remove-horizontal">

                    <h4 class="text-secondary">Premiación de carteles</h4>
                    <hr class="uk-divider-small">

                    <p class="uk-margin-medium-top">Se premiarán a los <b>tres mejores</b> de nuestro evento. Los premios consistirán en una inscripción gratuita al siguiente congreso del CONIITCH, 
                    y libros académicos de interés.</p>

                </article>
            </div>

        </div>

    </section>

    <section class="gradient-primary-left uk-margin-large" style="padding-bottom: 80px; margin-bottom: 100px;">
        
        <div class="uk-container uk-padding-large">

            <h2 class="text-white">Conferencistas Magistrales</h2>
            <hr class="uk-divider-small">

            <div class="uk-margin-large" uk-slider="infinite: true;">

                <div class="uk-position-relative uk-visible-toggle">
            
                    <ul class="uk-slider-items uk-grid uk-grid-match uk-child-width-1-3@xl uk-child-width-1-2@m" uk-scrollspy="target: > li; cls:uk-animation-fade; delay: 400">

                        <li>
                            <article class="uk-card uk-card-default uk-card-body uk-flex uk-flex-column uk-flex-middle uk-text-center">
                            
                                <div class="avatar-container" style="width: 150px; height: 150px;">
                                    <img data-src="{{ asset('images/basarab.jpg') }}" uk-img alt="Basarab Nicolescu">
                                </div>

                                <h4>Dr.Basarab Nicolescu</h4>
                                <hr class="uk-divider-small">

                                <p>El Dr. Basarab Nicolescu quien es un investigador físico rumano radicado en Francia experto en temas de transdisciplina, fundador y presidente del 
                                <b>Centro Internacional de Investigaciones y Estudios Transdisciplinarios</b> muy reconocido a nivel mundial</p>

                            </article>
                        </li>
                        <li>
                            <article class="uk-card uk-card-default uk-card-body uk-flex uk-flex-column uk-flex-middle uk-text-center">
                            
                                <div class="avatar-container" style="width: 150px; height: 150px;">
                                    <img data-src="{{ asset('images/sarah.jpg') }}" uk-img alt="Basarab Nicolescu">
                                </div>

                                <h4>Dra. Sarah Gehlert</h4>
                                <hr class="uk-divider-small">

                                <p>Tendremos también la presencia de la Dra. Sarah Gehlert, <b>Decana de la Facultad de Trabajo Social de la Universidad de Carolina del Sur</b>, 
                                quien ha trabajado en temas inter y transdisciplinarios.</p>

                            </article>
                        </li>
                        <li>
                            <article class="uk-card uk-card-default uk-card-body uk-flex uk-flex-column uk-flex-middle uk-text-center">
                            
                                <div class="avatar-container" style="width: 150px; height: 150px;">
                                    <img data-src="{{ asset('images/maria.jpg') }}" uk-img alt="Basarab Nicolescu">
                                </div>

                                <h4>Dra. María Luisa Marván</h4>
                                <hr class="uk-divider-small">

                                <p>La Dra. María Luisa Marván, <b>Profesora investigadora del Instituto de Investigaciones Psicológicas, Universidad Veracruzana</b>, miembro del 
                                SNI nivel III, experta en temas de salud y sociedad.</p>

                            </article>
                        </li>
                        <li>
                            <article class="uk-card uk-card-default uk-card-body uk-flex uk-flex-column uk-flex-middle uk-text-center">
                            
                                <div class="avatar-container" style="width: 150px; height: 150px;">
                                    <img data-src="{{ asset('images/paulina.jpg') }}" uk-img alt="Basarab Nicolescu">
                                </div>

                                <h4>Dra. Paulina Rivero Weber</h4>
                                <hr class="uk-divider-small">

                                <p>La Dra. Paulina Rivero Weber es licenciada, maestra y doctora en Filosofía por la Facultad de Filosofía y Letras de la UNAM. <b>Directora del 
                                programa universitario de Bioética de la UNAM y miembro del Sistema Nacional de Investigadores nivel II</b>.</p>

                            </article>
                        </li>
                        
                    </ul>
            
                    <a class="rounded-button-icon-light uk-position-small" role="button" uk-slider-item="previous" uk-icon="icon: arrow-left; ratio: 1.5" uk-scrollspy="cls:uk-animation-fade; delay: 400"></a>
                    <a class="rounded-button-icon-light uk-position-small" role="button" uk-slider-item="next" uk-icon="icon: arrow-right; ratio: 1.5" uk-scrollspy="cls:uk-animation-fade; delay: 400"></a>
            
                </div>
            
            </div>

        </div>

    </section>

    <section class="uk-container uk-margin-large" uk-scrollspy="target: > h2,hr,h4; cls:uk-animation-slide-top-medium; delay: 500">  

        <h2 class="uk-text-right">Programa</h2>
        <hr class="uk-divider-small uk-text-right">

        <h4>Miércoles 22 de mayo</h4>

        <ul class="uk-list uk-list-bullet uk-margin-medium-bottom uk-padding" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 500">
            <li class="uk-margin">
                <span class="uk-text-meta">09:00 - 10:00 horas</span>
                <h5 class="uk-margin-remove">Registro</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">10:00 - 14:00 horas</span>
                <h5 class="uk-margin-remove">Taller: ¿Qué es la Transdisciplina? - Dr. César Mureddu</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">14:00 - 15:00 horas</span>
                <h5 class="uk-margin-remove">Registro</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">15:00 - 19:00 horas</span>
                <h5 class="uk-margin-remove">Taller: Comunicación en salud: Posibilidades prácticas para la reflexión y la acción - Dr. Luis Antonio Reyna Martínez y
                    Dra. Marisol Campos Rivera
                </h5>
            </li>
        </ul>

        <hr>
        
        <h4>Jueves 23 de mayo</h4>

        <ul class="uk-list uk-list-bullet uk-margin-medium-bottom uk-padding" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 500">
            <li class="uk-margin">
                <span class="uk-text-meta">08:00 - 09:00 horas</span>
                <h5 class="uk-margin-remove">Registro</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">09:00 - 10:00 horas</span>
                <h5 class="uk-margin-remove">Inauguración - Dra. Ma de la Cruz Bernarda Téllez Alanís </h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">10:00 - 11:30 horas</span>
                <h5 class="uk-margin-remove">Conferencia Magistral: "Transdisciplinarity - A Hope for Humanity" - Dr. Basarab Nicolescu</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">11:30 - 12:00 horas</span>
                <h5 class="uk-margin-remove">Receso</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">12:00 - 13:00 horas</span>
                <h5 class="uk-margin-remove">Exposición y discusión de carteles</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">13:00 - 14:00 horas</span>
                <h5 class="uk-margin-remove">Simposio: "Salud y Transdisciplina en la UAEM" - Moderadora: Dra. Bernarda Téllez</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">14:00 - 16:00 horas</span>
                <h5 class="uk-margin-remove">Comida</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">16:00 - 17:00 horas</span>
                <h5 class="uk-margin-remove">Conferencia Magistral: “Using transdisciplinary science to translate research into solutions” - Dra. Sarah Gehlert</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">17:00 - 18:00 horas</span>
                <h5 class="uk-margin-remove">Mesa de trabajos libres / Simposio</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">18:00 - 18:15 horas</span>
                <h5 class="uk-margin-remove">Receso</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">18:15 - 19:15 horas</span>
                <h5 class="uk-margin-remove">Mesa de trabajos libres / Simposio</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">19:15 horas</span>
                <h5 class="uk-margin-remove">Brindis de bienvenida y Evento Cultural</h5>
            </li>
        </ul>

        <hr>

        <h4>Viernes 24 de mayo</h4>

        <ul class="uk-list uk-list-bullet uk-margin-medium-bottom uk-padding" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 500">
            <li class="uk-margin">
                <span class="uk-text-meta">08:00 - 09:00 horas</span>
                <h5 class="uk-margin-remove">Registro</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">9:00 - 10:30 horas</span>
                <h5 class="uk-margin-remove">Conferencia Magistral: “Barreras Psicosociales hacia la donación de órganos postmortem” - Dra. Ma. Luisa Marván</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">10:30 - 11:30 horas</span>
                <h5 class="uk-margin-remove">Simposio: "La Transdisciplinariedad - Problemáticas y Retos Analíticos" - Moderadora: Dra. Julieta Hidar</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">11:30 - 12:00 horas</span>
                <h5 class="uk-margin-remove">Receso</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">12:00 - 13:00 horas</span>
                <h5 class="uk-margin-remove">Exposición y discusión de carteles</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">13:00 - 14:00 horas</span>
                <h5 class="uk-margin-remove">Conferencia Magistral: “Libertad y responabilidad ante la crisis ecológica actual” - Dra. Paulina Rivero Weber</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">14:00 - 16:00 horas</span>
                <h5 class="uk-margin-remove">Comida</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">16:00 - 17:00 horas</span>
                <h5 class="uk-margin-remove">Mesa de trabajos libres / Simposio</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">17:00 - 18:30 horas</span>
                <h5 class="uk-margin-remove">Mesa de Conclusiones</h5>
            </li>
            <li class="uk-margin">
                <span class="uk-text-meta">18:30 horas</span>
                <h5 class="uk-margin-remove">Clausura y Premiación de carteles</h5>
            </li>
        </ul>
        
    </section>

@endsection