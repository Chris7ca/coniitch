<?php

Route::get('asistencia',                                        'Staff\AttendancesController@view')->name('attendances.view');
Route::post('asistencia',                                       'Staff\AttendancesController@index')->name('attendances.index');
Route::post('asistencia/evento/{id}/usuario/{uuid}/asignar',    'Staff\AttendancesController@assign')->name('attendances.assign');