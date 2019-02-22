<?php

/**
 * Trabajos (Revisors)
 */

Route::get('trabajos',                                    'Revisors\WorksController@view')->name('works.view');
Route::post('trabajos',                                   'Revisors\WorksController@index')->name('works.index');
Route::post('trabajos/{id}/confirmar',                    'Revisors\WorksController@confirmation')->name('works.confirmation');
Route::post('trabajos/criterios',                         'Revisors\WorksController@criterias')->name('works.criterias');
Route::post('trabajos/{id}/evaluar',                      'Revisors\WorksController@evaluate')->name('works.evaluate');