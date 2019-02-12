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

Route::get('/',                                             'AppController@index')->name('index');

/**
 * Notificaciones
 */

Route::get('notificaciones',                                'NotificationsController@view')->name('notifications.view');
Route::post('notificaciones',                               'NotificationsController@index')->name('notifications.index');
Route::post('notificaciones/widget',                        'NotificationsController@widget')->name('notifications.widget');
Route::post('notificaciones/{uuid}/ver',                    'NotificationsController@read')->name('notifications.read');

/**
 * Usuarios
 */

Route::get('usuarios',                                      'Root\UsersController@view')->name('users.view');
Route::post('usuarios',                                     'Root\UsersController@index')->name('users.index');
Route::post('usuarios/search',                              'Root\UsersController@search')->name('users.search');
Route::post('usuarios/guardar',                             'Root\UsersController@store')->name('users.store');
Route::post('usuarios/{id}/editar',                         'Root\UsersController@edit')->name('users.edit');
Route::post('usuarios/{id}/actualizar',                     'Root\UsersController@update')->name('users.update');
Route::delete('usuarios/{id}/eliminar',                     'Root\UsersController@delete')->name('users.delete');

Route::post('usuarios/estadisticas',                        'Root\UsersController@statistics')->name('users.statistics');

/**
 * Roles
 */

Route::get('roles',                                         'Root\RolesController@view')->name('roles.view');
Route::post('roles',                                        'Root\RolesController@index')->name('roles.index');
Route::post('roles/search',                                 'Root\RolesController@forSimpleSearch')->name('roles.simple.search');
Route::post('roles/guardar',                                'Root\RolesController@store')->name('roles.store');
Route::post('roles/{id}/editar',                            'Root\RolesController@edit')->name('roles.edit');
Route::post('roles/{id}/update',                            'Root\RolesController@update')->name('roles.update');
Route::delete('roles/{id}/eliminar',                        'Root\RolesController@delete')->name('roles.delete');

/**
 * Perfiles
 */

Route::get('perfil/editar',                                 'Congressman\ProfilesController@view')->name('profiles.view');
Route::post('perfiles/{id}/ver',                            'Congressman\ProfilesController@show')->name('profiles.show');

Route::post('perfiles/avatar/actualizar',                   'Congressman\PersonalProfileController@avatar')->name('profiles.avatar.update');

Route::post('perfil/personal/editar',                       'Congressman\PersonalProfileController@edit')->name('profiles.personal.edit');
Route::post('perfil/personal/actualizar',                   'Congressman\PersonalProfileController@update')->name('profiles.personal.update');

Route::post('perfil/academico/editar',                      'Congressman\AcademicProfileController@edit')->name('profiles.academic.edit');
Route::post('perfil/academico/actualizar',                  'Congressman\AcademicProfileController@update')->name('profiles.academic.update');

Route::post('perfil/profesional/editar',                    'Congressman\ProfessionalProfileController@edit')->name('profiles.professional.edit');
Route::post('perfil/profesional/actualizar',                'Congressman\ProfessionalProfileController@update')->name('profiles.professional.update');

Route::post('contacto/emergencia/editar',                   'Congressman\EmergencyContactController@edit')->name('emergency.contact.edit');
Route::post('contacto/emergencia/actualizar',               'Congressman\EmergencyContactController@update')->name('emergency.contact.update');

Route::post('perfil/contrasena/actualizar',                 'AppController@password')->name('user.password.update');

/**
 * Sponsors
 */

Route::get('patrocionadores',                               'PublicRelations\Sponsors@view')->name('sponsors.view');
Route::post('patrocionadores',                              'PublicRelations\Sponsors@index')->name('sponsors.index');
Route::post('patrocionadores/guardar',                      'PublicRelations\Sponsors@store')->name('sponsors.store');
Route::post('patrocionadores/{id}/editar',                  'PublicRelations\Sponsors@edit')->name('sponsors.edit');
Route::post('patrocionadores/{id}/actualizar',              'PublicRelations\Sponsors@update')->name('sponsors.update');
Route::delete('patrocionadores/{id}/eliminiar',             'PublicRelations\Sponsors@delete')->name('sponsors.delete');

/**
 * Criterios de evaluación
 */

Route::get('trabajos/criterios',                            'Admin\EvaluationCriteriaController@view')->name('criterias.view');
Route::post('trabajos/criterios',                           'Admin\EvaluationCriteriaController@index')->name('criterias.index');
Route::post('trabajos/criterios/guardar',                   'Admin\EvaluationCriteriaController@store')->name('criterias.store');
Route::post('trabajos/criterios/{id}/editar',               'Admin\EvaluationCriteriaController@edit')->name('criterias.edit');
Route::post('trabajos/criterios/{id}/actualizar',           'Admin\EvaluationCriteriaController@update')->name('criterias.update');
Route::delete('trabajos/criterios/{id}/eliminar',           'Admin\EvaluationCriteriaController@delete')->name('criterias.delete');

/**
 * Convocatoria
 */

Route::get('convocatoria',                                  'Congressman\WorksController@view')->name('announcement.view');
Route::post('convocatoria/trabajos/guardar',                'Congressman\WorksController@save')->name('announcement.save');
Route::post('convocatoria/trabajos/{id}/confirmar',         'Congressman\WorksController@confirm')->name('announcement.confirm');

Route::get('convocatoria/coautoria',                        'Congressman\WorksController@confirmCoauthor')->name('announcement.coauthor.confirm');

Route::get('convocatoria/trabajos/{id}/ver',                'Congressman\WorksController@show')->name('announcement.works.show');

/**
 * Trabajos
 */

Route::get('admin/trabajos',                                    'Admin\WorksController@view')->name('admin.works.view');
Route::post('admin/trabajos',                                   'Admin\WorksController@index')->name('admin.works.index');
Route::post('admin/trabajos/revisores',                         'Admin\WorksController@revisors')->name('admin.works.revisors');
Route::post('admin/trabajos/{id}/asignar',                      'Admin\WorksController@assign')->name('admin.works.assign.revisors');
Route::post('admin/trabajos/{id}/evaluacion/confirmar',         'Admin\WorksController@confirm')->name('admin.works.evaluation.confirm');

/**
 * Revisores
 */

Route::get('revisores/trabajos',                                'Revisors\WorksController@view')->name('revisors.works.view');
Route::post('revisores/trabajos',                               'Revisors\WorksController@index')->name('revisors.works.index');
Route::post('revisores/trabajos/{id}/confirmar',                'Revisors\WorksController@confirmation')->name('revisors.works.confirmation');
Route::post('revisores/trabajos/criterios',                     'Revisors\WorksController@criterias')->name('revisors.works.criterias');
Route::post('revisores/trabajos/{id}/evaluar',                  'Revisors\WorksController@evaluate')->name('revisors.works.evaluate');