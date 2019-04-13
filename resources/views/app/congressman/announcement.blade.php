@extends('layouts.app')

@section('title', 'Registro de trabajos')

@section('hero', 'Registro')

@section('content')
    
    <section class="uk-container uk-margin-large-bottom">

        @if ( empty($work) || !$work->ready )

            <h3 class="uk-text-center">El tiempo para la recepción de trabajos ha finalizado.</h3>
            <h4 class="uk-text-center">¡Muchas gracias!</h4>
        
            {{-- <h3>Registro de trabajos</h3>
            <hr class="uk-divider-small">

            <p><small>Si desea participar en el 3<sup>er</sup> Congreso Internacional de Investigación en Ciencias Humanas 2019. Por favor registra tu trabajo conforme a los líneamientos
            establecidos en la <a class="text-secondary uk-text-bold" href="{{ route('site.announcement') }}">convocatoria</a>. Tiene hasta el <b>domingo 31 de marzo del 2019 a las 23:59 horas</b> 
            para registrar su trabajo.</small></p>

            <p><small><strong>Nota I.</strong> Puede guardar su trabajo y suspender su edición para retomarlo en el mismo punto donde lo dejó, únicamente debe asegurarse oprimir el botón 
            <strong class="text-secondary">Guardar</strong> para que sus avances se almacenen. Una vez esté completamente seguro que ha finalizado la edición de la información o el resumen del 
            trabajo, deberá oprimir el botón <strong class="text-secondary">Registrar trabajo</strong>; una vez hecho esto, no habrá forma que pueda modificar la información que introdujo
            por lo que no lo haga hasta que esté seguro que no modificará más su información.</small></p>

            <p><small><strong>Nota II.</strong> Si no asigna un autor principal (en caso de que aplique) se entiende que usted es el autor principal.</small></p>

            <p><small><strong>Nota III.</strong> Le recordamos que el sistema solo permite recibir un trabajo por autor/persona. 
            Si usted requiere enviar más de un trabajo, sus co-autores podrán registrarlo. Si tiene dudas contáctenos al correo <b class="text-secondary">trabajos.coniitch@uaem.mx</b></small></p>

            <work :org-work="{{ json_encode($work) }}" :mode="'register'"></work> --}}

        @elseif ( $work->evaluation == 1 || $work->evaluation == 2 )

            <h3 class="text-secondary">¡Buenas noticias!</h3>

            <p>Le notificamos que la comisión evaluadora del CONIITCH ha resuelto que su trabajo titulado <b>"{{ $work->title }}"</b> ha sido <b>aceptado</b>
            por la Comisión Científica para ser presentado en el 3er Congreso de Investigación Transdisciplinar en Ciencias Humanas 2019.</p>

            @if ( $work->evaluation == 2 )
                <p>Únicamente deberá realizar algunas modificaciones menores que la Comisión Científica le hizo, tome en cuenta sus observaciones.</p>

            @elseif ( $work->evaluation == 1 )
                <p>Sobre la selección de trabajos y asignación de la modalidad de presentación:</p>
                <p>Debido a la alta demanda de trabajos y al número limitado de espacios, el comité Científico le notificará vía correo electrónico la modalidad de presentación (oral o póster) sobre su participación en nuestro programa del congreso.
                La presentación se realizará en el día, horario y orden señalado en la carta de aceptación que se le enviará a su correo posterior al dictamen de Aprobado. En caso de que el resumen sea aceptado en formato de cartel se le harán llegar el formato e instrucciones para la presentación del mismo.
                En caso de que el autor corresponsal no acepte la modalidad elegida deberá notificarlo por correo electrónico al Comité Científico (<b>congreso.coniitch@uaem.mx</b>)</p>
            @endif

            <p>Las observaciones que hicieron a su trabajo fueron las siguientes:</p>

            @foreach ($work->reviews as $review)
                <p><i>"{{ $review->feedback }}"</i></p>
            @endforeach

            @if ( $work->evaluation == 2 )
                <work :org-work="{{ json_encode($work) }}" :mode="'update'"></work>
            @endif

        @elseif ( $work->evaluation == 3 )

            <h3 class="text-secondary">¡Tenemos noticias!</h3>

            <p>Le notificamos que la comisión evaluadora del CONIITCH ha resuelto que su trabajo titulado <b>"{{ $work->title }}"</b> ha sido sido considerado como <b>no aceptado</b>
            por la Comisión Científica del 3er Congreso de Investigación Transdisciplinar en Ciencias Humanas 2019.</p>

            <p>Algunas de las observaciones que hicieron a su trabajo fueron las siguientes: </p>

            @foreach ($work->reviews as $review)
                <p><i>"{{ $review->feedback }}"</i></p>
            @endforeach

            <p>Le reiteramos nuestro agradecimiento y esperamos pueda acompañarnos en el congreso para que pueda disfrutar tanto de los Talleres pre-cogreso como del programa en general.</p>
        
        @elseif ( $work->version>= 2 && $work->evaluation == null )

            <div class="uk-flex uk-flex-center">

                <div class="uk-text-center">
                    <h3 class="text-secondary">¡Muy bien!</h3>

                    <img data-src="{{ asset('images/okok.gif') }}" width="" uk-img>

                    <h4 class="uk-margin-top-remove">
                        Notificaremos a sus revisores sobre los cambios realizados a este trabajo. Dentro de poco tendrá noticias sobre el dictamen que emitan.
                    </h4>
                </div>

            </div>
            
        @else

            <div class="uk-flex uk-flex-center">

                <div class="uk-text-center">
                    <h3 class="text-secondary">¡Excelente!</h3>

                    <img data-src="{{ asset('images/okok.gif') }}" width="" uk-img>

                    <h4 class="uk-margin-top-remove">
                        Hemos recibido su trabajo y lo asignaremos a un par de investigadores expertos para su evaluación. En breve se le notificará sobre dicha evaluación.
                    </h4>
                </div>

            </div>

        @endif


    </section>

@endsection

@push('js')
    <script src="{{ asset('editor/ckeditor.js') }}" defer></script>
    <script src="{{ mix('js/announcement.js') }}" defer></script>
@endpush