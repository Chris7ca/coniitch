@extends('layouts.site')

@section('title', 'Directorio')

@section('content')
    
    <main class="uk-background-cover" data-src="{{ asset('images/directory.jpg') }}" uk-img>
            
        <div class="gradient-background-top uk-position-relative" uk-height-viewport="offset-bottom: 30">
            
            @include('layouts.headersite')
            
            <article class="uk-container uk-text-center uk-light uk-position-center uk-margin" uk-scrollspy="target: > *; cls:uk-animation-fade; delay: 500">
                
                <h1>Directorio</h1>
                
            </article>
            
        </div>
        
    </main>

    <section class="uk-container uk-margin-large" style="padding-top: 80px; padding-bottom: 100px;">

        <h2>Comité organizador</h2>
        <hr class="uk-divider-small">

        <table class="uk-table uk-table-divider uk-table-responsive">

            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Rol</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Dra. Bernarda Téllez Alanís</td>
                    <td>Presidente del Congreso</td>
                </tr>
                <tr>
                    <td>Dra. Esperanza López Vázquez</td>
                    <td>Presidente del Comité Científico</td>
                </tr>
                <tr>
                    <td>Mtra. Kenya Martínez Tinajero</td>
                    <td>Coordinadora General</td>
                </tr>
                <tr>
                    <td>Lic. Elizabeth Raimondi Jímenez</td>
                    <td>Coordinadora de Logística</td>
                </tr>
                <tr>
                    <td>Mtro. Carlos Aragón Carrillo</td>
                    <td>Coordinador de Relaciones Públicas</td>
                </tr>
                <tr>
                    <td>Psic. Noemí Nava Rivera</td>
                    <td>Coordinadora de Finanzas y Tesorería</td>
                </tr>
                <tr>
                    <td>Mtra. Ulizec Ortíz Duque</td>
                    <td>Coordinadora de Difusión</td>
                </tr>
            </tbody>

        </table>

        <h2>Comité científico</h2>
        <hr class="uk-divider-small">

        <table class="uk-table uk-table-divider uk-table-responsive">

            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Adscripción</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Dra. Esperanza López Vázquez</td>
                    <td>CITPsi</td>
                </tr>
                <tr>
                    <td>Dra. Bernarda Téllez Alanis</td>
                    <td>CITPsi</td>
                </tr>
                <tr>
                    <td>Dra. Imke Hindrichs</td>
                    <td>CITPsi</td>
                </tr>
                <tr>
                    <td>Dra. Gabriela López Aymes</td>
                    <td>CITPsi</td>
                </tr>
                <tr>
                    <td>Dr. Germán López Riquelme</td>
                    <td>CINCO</td>
                </tr>
                <tr>
                    <td>Mtro. Emmanuel Poblete Trujillo</td>
                    <td>CITPsi</td>
                </tr>
                <tr>
                    <td>Mtra. Belem Quezada Díaz</td>
                    <td>CITPsi</td>
                </tr>
                <tr>
                    <td>Dr. Manuel Aguilar Tamayo</td>
                    <td>ICE</td>
                </tr>
                <tr>
                    <td>Dr. Arturo Juárez García</td>
                    <td>CITPsi</td>
                </tr>
                <tr>
                    <td>Mtra. Oniria Gutiérrez Ramos</td>
                    <td>Escuela de Estudios Superiores del Jicarero</td>
                </tr>
                <tr>
                    <td>Lic. Nenetzin Álvarez Velasco</td>
                    <td>Escuela de Estudios Superiores del Jicarero</td>
                </tr>
            </tbody>

        </table>

    </section>

@endsection