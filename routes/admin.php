<?php

/**
 * Criterios de evaluación 
 */

Route::get('trabajos/criterios',                                    'Admin\EvaluationCriteriaController@view')->name('criterias.view');
Route::post('trabajos/criterios',                                   'Admin\EvaluationCriteriaController@index')->name('criterias.index');
Route::post('trabajos/criterios/guardar',                           'Admin\EvaluationCriteriaController@store')->name('criterias.store');
Route::post('trabajos/criterios/{id}/editar',                       'Admin\EvaluationCriteriaController@edit')->name('criterias.edit');
Route::post('trabajos/criterios/{id}/actualizar',                   'Admin\EvaluationCriteriaController@update')->name('criterias.update');
Route::delete('trabajos/criterios/{id}/eliminar',                   'Admin\EvaluationCriteriaController@delete')->name('criterias.delete');



/**
 * Trabajos 
 */

Route::get('trabajos',                                              'Admin\WorksController@view')->name('works.view');
Route::post('trabajos',                                             'Admin\WorksController@index')->name('works.index');
Route::post('trabajos/revisores',                                   'Admin\WorksController@revisors')->name('works.revisors');
Route::post('trabajos/{id}/asignar',                                'Admin\WorksController@assign')->name('works.assign.revisors');
Route::post('trabajos/{id}/evaluacion/confirmar',                   'Admin\WorksController@confirm')->name('works.evaluation.confirm');

/**
 * Estadísticas
 */

Route::post('trabajos/aceptados',                                   'Admin\WorksController@acceptedWorks')->name('works.accepted');