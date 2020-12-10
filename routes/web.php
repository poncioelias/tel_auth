<?php
/*
 * Descomentado linha 29 no arquivo Providers/RouteServiceProvider.php
 * para acesso a forma antiga de gerar as rotas
*/

use Illuminate\Support\Facades\Route; 

Route::get('/error',function(){
  return view('template_auth.error.index');
});

Route::get('/session','SessionController@session')->name('session.get');
Route::get('/setsession','SessionController@storeSession')->name('session.set');

Route::get('/{id_system?}','LoginController@index')->name('home');
Route::get('/redefinicao','LoginController@resetpasswd')->name('resetpasswd');

Route::post('/login','LoginController@login')->name('login');
Route::post('/register','LoginController@register')->name('register');
Route::post('/recover','LoginController@recover')->name('recover');







