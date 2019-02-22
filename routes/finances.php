<?php

/**
 * Registros 
 */

Route::get('registros',                                             'Finances\RecordsController@view')->name('records.view');
Route::post('registros',                                            'Finances\RecordsController@index')->name('records.index');
Route::post('registros/{id}/documentos/validacion',                 'Finances\RecordsController@document')->name('records.documents.validation');

/**
 * Servicios 
 */

Route::get('servicios',                                             'Finances\ServicesController@view')->name('services.view');
Route::post('servicios',                                            'Finances\ServicesController@index')->name('services.index');
Route::post('servicios/guardar',                                    'Finances\ServicesController@save')->name('services.save');
Route::delete('servicios/{id}/eliminar',                            'Finances\ServicesController@deleteService')->name('services.delete');

Route::post('servicios/{id}/promociones/guardar',                   'Finances\ServicesController@discount')->name('services.discount');
Route::delete('servicios/{id}/promociones/{ID}/eliminar',           'Finances\ServicesController@deleteDiscount')->name('services.discount.delete');

/**
 * Pagos 
 */

Route::get('pagos',                                                 'Finances\PaymentsController@view')->name('payments.view');
Route::post('pagos',                                                'Finances\PaymentsController@index')->name('payments.index');
Route::post('pagos/{id}/aprovar',                                   'Finances\PaymentsController@confirmation')->name('payments.confirmation');

Route::post('pagos/facturacion/datos/{id}',                         'Finances\PaymentsController@invoicingData')->name('payments.invoicing.data');