<?php

/**
 * Perfiles 
 */

Route::post('perfiles/academico/editar',                            'Congressman\AcademicProfileController@edit')->name('profile.academic.edit');
Route::post('perfiles/academico/actualizar',                        'Congressman\AcademicProfileController@update')->name('profile.academic.update');

Route::post('perfiles/profesional/editar',                          'Congressman\ProfessionalProfileController@edit')->name('profile.professional.edit');
Route::post('perfiles/profesional/actualizar',                      'Congressman\ProfessionalProfileController@update')->name('profile.professional.update');

Route::post('contacto/emergencia/editar',                           'Congressman\EmergencyContactController@edit')->name('emergency.contact.edit');
Route::post('contacto/emergencia/actualizar',                       'Congressman\EmergencyContactController@update')->name('emergency.contact.update');

Route::post('facturacion/editar',                                   'Congressman\InvoicingController@edit')->name('invoicing.edit');
Route::post('facturacion/actualizar',                               'Congressman\InvoicingController@update')->name('invoicing.update');

/**
 * Convocatoria 
 */

// Route::get('convocatoria',                                          'Congressman\WorksController@view')->name('announcement.view');
// Route::post('convocatoria/trabajos/guardar',                        'Congressman\WorksController@save')->name('announcement.save');
// Route::post('convocatoria/trabajos/{id}/confirmar',                 'Congressman\WorksController@confirm')->name('announcement.confirm');

// Route::get('convocatoria/coautoria',                                'Congressman\WorksController@confirmCoauthor')->name('announcement.coauthor.confirm');

Route::get('convocatoria/trabajos/{id}/ver',                        'Congressman\WorksController@show')->name('announcement.works.show');

/**
 * Pagos 
 */

Route::get('pagos',                                                 'Congressman\PaymentsController@view')->name('payments.view');
Route::post('pagos/servicios',                                      'Congressman\PaymentsController@services')->name('payments.services');
Route::post('pagos/carrito',                                        'Congressman\PaymentsController@cart')->name('payments.cart');
Route::post('pagos/carrito/agregar',                                'Congressman\PaymentsController@addCart')->name('payments.add.cart');
Route::delete('pagos/carrito/{id}/eliminar',                        'Congressman\PaymentsController@deleteCart')->name('payments.delete.cart');
Route::post('pagos/servicios/{id}/voucher',                         'Congressman\PaymentsController@voucher')->name('payments.services.voucher');

Route::post('pagos/crear',                                          'PaypalController@create')->name('payments.create');
Route::post('pagos/ejecutar',                                       'PaypalController@execute')->name('payments.execute');