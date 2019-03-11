@extends('layouts.site')

@section('title', 'Términos y Condiciones')

@section('content')
    
    <main class="uk-background-cover" data-src="{{ asset('images/privacy.jpg') }}" uk-img>
            
        <div class="gradient-background-top uk-position-relative" uk-height-viewport="offset-bottom: 30">
            
            @include('layouts.headersite')
            
            <article class="uk-container uk-text-center uk-light uk-position-center uk-margin" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 500">
                
                <h1>Términos y Condiciones</h1>
                
            </article>
            
        </div>
        
    </main>

    <section class="uk-container uk-margin-large" style="padding-top: 80px; padding-bottom: 100px;">

        <article>

            <h2>Términos y Condiciones del sitio web del 3er Congreso Internacional de Investigación Transdisciplinar en Ciencias Humanas</h2>
            <span class="uk-text-meta">Última actualización: 25 de diciembre de 2018.</span>
            <hr class="uk-divider-small">

            <p>Los siguientes términos y condiciones rigen el uso que usted le dé a este sitio web y a cualquiera de los contenidos disponibles por o a través de este sitio web, 
            incluyendo cualquier contenido derivado del mismo. El Centro de Investigación Transdisciplinar en Psicología de Investigación Transdisciplinar en Psicología ha puesto a su disposición el Sitio Web. Podemos cambiar los 
            Términos y Condiciones de vez en cuando, en cualquier momento sin ninguna notificación, sólo publicando los cambios en el Sitio Web. 
            <b>AL USAR EL SITIO WEB, USTED ACEPTA Y ESTÉ DE ACUERDO CON ESTOS TÉRMINOS Y CONDICIONES EN LO QUE SE REFIERE A SU USO DEL SITIO WEB</b>. Si usted no está de acuerdo con estos 
            Términos y Condiciones, no puede tener acceso al mismo ni usar el Sitio Web de ninguna otra manera.</p>

            <h4>Licencia</h4>
            
            <p>El Centro de Investigación Transdisciplinar en Psicología través de su sitio web del 3er Congreso Internacional de Investigación Transdisciplinar en Ciencias Humanas 
            concede una licencia para que los usuarios vean, compartan la información contenida en este sitio web de acuerdo a los Términos y Condiciones que se describen en este documento.</p>

            <h4>Uso no autorizado</h4>

            <p>En ningún caso usted puede modificar para venta de software, templetes, u otro producto de diseño y/o programación, completo o alguna sección de nuestro sitio web y ofrecerlos para 
            la redistribución o la reventa de ningún tipo.</p>

            <h4>Propiedad</h4>

            <p>Todos los contenidos, marcas, logos, dibujos, documentación, software o cualquier otro elemento susceptible de protección por la legislación de propiedad intelectual 
            o industrial, que sean accesibles en sitio web corresponden exclusivamente al Centro de Investigación Transdisciplinar en Psicología o a sus legítimos titulares y quedan 
            expresamente reservados todos los derechos sobre los mismos. A continuación se listan los derechos de terceros sobre material digital (imágenes, logos e iconos):</p>

            <ul class="uk-list">
                
                <li><b>Imágenes</b>. Algunas imagenes han sido tomadas de bancos de imágenes con licencia <a href="https://creativecommons.org/publicdomain/zero/1.0/legalcode" target="_blank">
                Creative Commons CC0</a></li>

                <li><b>Logos</b>. Los logos aquí presentados, salvo el logo del Congreso Internacional de Investigación Transdisciplinar en Ciencias Humanas, Centro de Investigación 
                Transdisciplinar en Psicología y la Universidad Autónoma del Estado de Morelos; pertenecen a los patrocinadores que han consensuado la publicidad en nuestro sitio web.</li>

                <li><b>Iconos</b>, algunos iconos de este sitio web fueron obtenidos del sitio <a href="flaticon.com" target="_blank">flaticon.com</a> y a continuación se otorgan los créditos
                correspondientes por cada uno de ellos:</li>

                <ul class="uk-list uk-margin">

                    <li>Icons made by <a href="https://www.flaticon.com/authors/monkik" title="monkik">monkik</a> from <a href="https://www.flaticon.com/" title="Flaticon">
                    www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></li>

                    <li>Icons made by <a href="https://www.freepik.com/" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> 
                    is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></li>

                </ul>

            </ul>

            <h4>Información del usuario</h4>

            <p>En el curso del uso que usted haga del sitio web y/o de los servicios puestos a su disposición en o a través del mismo, se le puede pedir que nos proporcione cierta información 
            personalizada (dicha información en lo sucesivo "Información del usuario"). Las políticas de uso y recopilación de información del Centro de Investigación Transdisciplinar en Psicología 
            con respecto a la privacidad de dicha Información del Usuario se establecen en la <a href="privacidad.html">Política de Privacidad</a> del sitio web, la cual está incorporada al 
            mismo como referencia para todos los propósitos. Usted reconoce y acepta ser el único responsable de la exactitud del contenido de la Información del Usuario.</p>

        </article>
    
    </section>

@endsection