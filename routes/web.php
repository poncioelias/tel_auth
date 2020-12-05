<?php
/*
 * Descomentado linha 29 no arquivo Providers/RouteServiceProvider.php
 * para acesso a forma antiga de gerar as rotas
*/

use Illuminate\Support\Facades\Route; 

Route::get('/{id_system?}','HomeController@index')->name('home');
Route::post('/login','HomeController@login')->name('login');
Route::post('/register','HomeController@register')->name('register');
Route::post('/recover','HomeController@recover')->name('recover');



