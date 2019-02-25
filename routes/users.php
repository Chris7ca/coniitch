<?php

/**
 * Notificaciones
 */

Route::get('notificaciones',                                        'Users\NotificationsController@view')->name('notifications.view');
Route::post('notificaciones',                                       'Users\NotificationsController@index')->name('notifications.index');
Route::post('notificaciones/widget',                                'Users\NotificationsController@widget')->name('notifications.widget');
Route::post('notificaciones/{uuid}/ver',                            'Users\NotificationsController@read')->name('notifications.read');

/**
 * Perfiles
 */

Route::get('perfiles/editar',                                       'Users\ProfilesController@view')->name('profile.edit');
Route::post('perfiles/{id}/ver',                                    'Users\ProfilesController@show')->name('profiles.show');

Route::post('perfiles/avatar/actualizar',                           'Users\PersonalProfileController@avatar')->name('avatar.update');

Route::post('perfiles/personal/editar',                             'Users\PersonalProfileController@edit')->name('profile.personal.edit');
Route::post('perfiles/personal/actualizar',                         'Users\PersonalProfileController@update')->name('profile.personal.update');

/**
 * Password
 */

Route::post('perfiles/contrasena/actualizar',                       'Users\UsersController@password')->name('password.update');

/**
 * Documentos
 */

Route::get('documentos',                                            'Users\UsersController@documents')->name('documents.view');