<?php

// use Illuminate\Support\Facades\DB;

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

Route::get('/',                                 'AppController@index')->name('index');

// Route::get('test', function(){

    

//     return $counts;

// });

/**
 * Usuarios
 */

Route::get('usuarios',                          'Root\UsersController@view')->name('users.view');
Route::post('usuarios',                         'Root\UsersController@index')->name('users.index');
Route::post('usuarios/search',                  'Root\UsersController@search')->name('users.search');
Route::post('usuarios/guardar',                 'Root\UsersController@store')->name('users.store');
Route::post('usuarios/{id}/editar',             'Root\UsersController@edit')->name('users.edit');
Route::post('usuarios/{id}/actualizar',         'Root\UsersController@update')->name('users.update');
Route::delete('usuarios/{id}/eliminar',         'Root\UsersController@delete')->name('users.delete');

Route::post('usuarios/estadisticas',             'Root\UsersController@statistics')->name('users.statistics');

/**
 * Roles
 */

Route::get('roles',                             'Root\RolesController@view')->name('roles.view');
Route::post('roles',                            'Root\RolesController@index')->name('roles.index');
Route::post('roles/search',                     'Root\RolesController@forSimpleSearch')->name('roles.simple.search');
Route::post('roles/guardar',                    'Root\RolesController@store')->name('roles.store');
Route::post('roles/{id}/editar',                'Root\RolesController@edit')->name('roles.edit');
Route::post('roles/{id}/update',                'Root\RolesController@update')->name('roles.update');
Route::delete('roles/{id}/eliminar',            'Root\RolesController@delete')->name('roles.delete');

/**
 * Perfiles
 */

Route::get('perfil/editar',                     'Congressman\ProfilesController@view')->name('profiles.view');
Route::post('perfiles/{id}/ver',                'Congressman\ProfilesController@show')->name('profiles.show');

Route::post('perfiles/avatar/actualizar',       'Congressman\PersonalProfileController@avatar')->name('profiles.avatar.update');

Route::post('perfil/personal/editar',           'Congressman\PersonalProfileController@edit')->name('profiles.personal.edit');
Route::post('perfil/personal/actualizar',       'Congressman\PersonalProfileController@update')->name('profiles.personal.update');

Route::post('perfil/academico/editar',          'Congressman\AcademicProfileController@edit')->name('profiles.academic.edit');
Route::post('perfil/academico/actualizar',      'Congressman\AcademicProfileController@update')->name('profiles.academic.update');

Route::post('perfil/profesional/editar',        'Congressman\ProfessionalProfileController@edit')->name('profiles.professional.edit');
Route::post('perfil/profesional/actualizar',    'Congressman\ProfessionalProfileController@update')->name('profiles.professional.update');

Route::post('contacto/emergencia/editar',       'Congressman\EmergencyContactController@edit')->name('emergency.contact.edit');
Route::post('contacto/emergencia/actualizar',   'Congressman\EmergencyContactController@update')->name('emergency.contact.update');

Route::post('perfil/contrasena/actualizar',     'AppController@password')->name('user.password.update');