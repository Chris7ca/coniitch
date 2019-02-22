<?php

/*
|--------------------------------------------------------------------------
| App Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * Sponsors (Public relations)
 */

Route::get('patrocionadores',                                       'PublicRelations\Sponsors@view')->name('sponsors.view');
Route::post('patrocionadores',                                      'PublicRelations\Sponsors@index')->name('sponsors.index');
Route::post('patrocionadores/guardar',                              'PublicRelations\Sponsors@store')->name('sponsors.store');
Route::post('patrocionadores/{id}/editar',                          'PublicRelations\Sponsors@edit')->name('sponsors.edit');
Route::post('patrocionadores/{id}/actualizar',                      'PublicRelations\Sponsors@update')->name('sponsors.update');
Route::delete('patrocionadores/{id}/eliminiar',                     'PublicRelations\Sponsors@delete')->name('sponsors.delete');
