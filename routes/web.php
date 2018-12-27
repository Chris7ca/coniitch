<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',             'SiteController@index')->name('site.index');
Route::get('contacto',      'SiteController@contact')->name('site.contact');
Route::get('convocatoria',  'SiteController@call')->name('site.call');
Route::get('costos',        'SiteController@pricing')->name('site.pricing');
Route::get('directorio',    'SiteController@directory')->name('site.directory');
Route::get('nosotros',      'SiteController@aboutus')->name('site.aboutus');
Route::get('privacidad',    'SiteController@privacy')->name('site.privacy');
Route::get('programa',      'SiteController@programme')->name('site.programme');
Route::get('terminos',      'SiteController@terms')->name('site.terms');


/**
 * Authentication Routes
 */

Route::get('acceder',                           'Auth\LoginController@showLoginForm')->name('site.login');
Route::post('login',                            'Auth\LoginController@login')->name('to.access');
Route::post('logout',                           'Auth\LoginController@logout')->name('logout');

Route::get('auth/{provider}',                   'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback',          'Auth\SocialAuthController@handleProviderCallback');

Route::get('registro',                          'Auth\RegisterController@showRegistrationForm')->name('site.register');
Route::post('register',                         'Auth\RegisterController@register')->name('signup');

Route::get('credenciales/reestablecer',         'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email',                   'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('credenciales/reestablecer/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset',                   'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('correo/verificacion',               'Auth\VerificationController@show')->name('verification.notice');
Route::get('correo/verificacion/{token}',       'Auth\VerificationController@verify')->name('verification.verify');
Route::get('correo/reenviar',                   'Auth\VerificationController@resend')->name('verification.resend');