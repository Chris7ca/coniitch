<?php

/**
 * Usuarios 
 */

Route::get('usuarios',                                              'Root\UsersController@view')->name('users.view');
Route::post('usuarios',                                             'Root\UsersController@index')->name('users.index');
Route::post('usuarios/search',                                      'Root\UsersController@search')->name('users.search');
Route::post('usuarios/guardar',                                     'Root\UsersController@store')->name('users.store');
Route::post('usuarios/{id}/editar',                                 'Root\UsersController@edit')->name('users.edit');
Route::post('usuarios/{id}/actualizar',                             'Root\UsersController@update')->name('users.update');
Route::delete('usuarios/{id}/eliminar',                             'Root\UsersController@delete')->name('users.delete');

Route::post('usuarios/estadisticas',                                'Root\UsersController@statistics')->name('users.statistics');

/**
 * Roles
 */

Route::get('roles',                                                 'Root\RolesController@view')->name('roles.view');
Route::post('roles',                                                'Root\RolesController@index')->name('roles.index');
Route::post('roles/search',                                         'Root\RolesController@forSimpleSearch')->name('roles.simple.search');
Route::post('roles/guardar',                                        'Root\RolesController@store')->name('roles.store');
Route::post('roles/{id}/editar',                                    'Root\RolesController@edit')->name('roles.edit');
Route::post('roles/{id}/update',                                    'Root\RolesController@update')->name('roles.update');
Route::delete('roles/{id}/eliminar',                                'Root\RolesController@delete')->name('roles.delete');