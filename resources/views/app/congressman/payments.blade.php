@extends('layouts.app')

@section('title', 'Pago de productos o servicios')

@section('hero', 'Pagos')

@section('content')
    
    <section class="uk-container uk-margin">

        <h3>Servicios y productos</h3>

        <div class="uk-grid uk-grid-collapse" uk-grid>
            
            <div class="uk-width-2-3@m">

                <div>
                    <services></services>
                </div>
                
            </div>

            <div class="uk-width-1-3@m">

                <div class="uk-card uk-card-body gradient-primary-right uk-light uk-box-shadow-xlarge" uk-sticky="bottom: true">
                    <cart></cart>
                </div>

            </div>

        </div>

    </section>

@endsection

@section('modals')
    
    <div id="modal-payment-methods" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
    
            <button class="uk-modal-close-default" type="button" uk-close></button>
    
            <ul uk-tab>
                <li><a role="button">Depósito</a></li>
                <li><a role="button">Transferencia</a></li>
                <li><a role="button">Paypal</a></li>
                <li><a role="button">Extranjeros</a></li>
            </ul>

            <ul class="uk-switcher uk-margin-medium">
                
                <li>

                    <h4>Depósito bancario</h4>
                    <hr class="uk-divider-small">

                    <p>
                        En cualquier Banco Santander de la República Mexicana, a nombre de <b>UAEM-CENTRO DE INVESTIGACIÓN TRANSDISCIPLINAR EN PSIC</b>, número de cuenta <b>65504253241</b>
                    </p>
                    <p>
                        <b>Referencia</b>: <b>{{ Auth::user()->reference() }}</b>
                    </p>
                    <p>
                        <b>Concepto</b>: nombre del servicio o producto (ejemplo: <b>Inscripción al congreso</b>)
                    </p>
                    <p>
                        <b>NOTA.</b> Una vez realizado el depósito bancario anote en el comprobante su nombre completo, escanee el mismo y adjúntelo en 
                        la sección “Enviar comprobante de pago”. Una vez realizado esto, se procederá a validar el pago y se te notificará el estado del mismo.
                    </p>

                </li>

                <li>

                    <h4>Transferencia electrónica</h4>
                    <hr class="uk-divider-small">

                    <p>
                        Puede realizarce desde banca en línea, aplicaciones móviles sin importar el banco a nombre de <b>UAEM-CENTRO DE INVESTIGACIÓN TRANSDISCIPLINAR EN PSIC, CLABE 014540655042532411</b>
                    </p>
                    <p>
                        <b>Referencia</b>: <b>{{ Auth::user()->reference() }}</b>
                    </p>
                    <p>
                        <b>Concepto</b>: nombre del servicio o producto (ejemplo: <b>Inscripción al congreso</b>)
                    </p>
                    <p>
                        <b>NOTA.</b> Una vez realizada transferencia electrónica anote en el comprobante su nombre completo, escanee el mismo y adjúntelo en 
                        la sección “Enviar comprobante de pago”. Una vez realizado esto, se procederá a validar el pago y se te notificará el estado del mismo.
                    </p>

                </li>

                <li>

                    <h4>Pago con Paypal</h4>
                    <hr class="uk-divider-small">

                    <p>
                        Para realizar pagos con Paypal deberá poseer una cuenta con dicho servicio de pagos en línea. Una vez Paypal nos notifique el correcto procesamiento del pago, recibirá 
                        el comprobante del mismo y el el estado del pago se verá reflejado de inmediato. Para agregar un producto o servicio a la cesata de pago en Paypal, deberá seleccionar
                        "Agregar" en cada producto o servicio.
                    </p>
                    <p>
                        <b>NOTA.</b> Para su mayor seguridad, el Centro de Investigación Transdisciplinar en Psicología no alamacena datos relacionados a sus tarjetas de crédito o débito.
                    </p>

                </li>

                <li>
                    
                    <h4>Pago en el extranjero</h4>
                    <hr class="uk-divider-small">

                    <p>Realizar depósito o transferencia bancaria internacional en su lugar de origen,indicando los siguientes datos:</p>
                    <ul>
                        <li>Banco beneficiario: <b>BMSXMXMMXXX BANCO SANTANDER (MÉXICO) SA</b></li>
                        <li>Nombre y número de cuenta del beneficiario: <b>UAEM-CENTRO DE INVESTIGACIÓN TRANSDISCIPLINAR EN PSIC, CLABE 014540655042532411</b></li>
                        <li>Referencia: <b>{{ Auth::user()->reference() }}</b></li>
                        <li>Concepto: nombre del servicio o producto (ejemplo: <b>Inscripción al congreso</b>)</li>
                    </ul>

                </li>
                
            </ul>
            
        </div>
    </div>

    <upload-voucher></upload-voucher>

@endsection

@push('js')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="{{ asset('js/payments.js') }}" defer></script>
@endpush