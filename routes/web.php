<?php
/*
 * Descomentado linha 29 no arquivo Providers/RouteServiceProvider.php
 * para acesso a forma antiga de gerar as rotas
*/


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\LoginController;


Route::get('/',function(){
  return redirect('/login');
});

Route::get('/login/{uri?}',[LoginController::class, 'index'])
      ->middleware('guest')
      ->name('login');

Route::post('/login/{uri?}',[LoginController::class, 'store'])
      ->middleware('guest')
      ->name('login.store');

Route::get('/logout/{uri?}',[LoginController::class, 'destroy'])
      ->middleware('auth')
      ->name('login.logout');

Route::get('/redefinicao',[LoginController::class, 'resetpasswd'])
      ->middleware('guest')
      ->name('login.resetpasswd');

Route::post('/register',[LoginController::class, 'register'])
      ->middleware('guest')
      ->name('login.register');

Route::post('/recover',[LoginController::class, 'recover'])
      ->middleware('guest')
      ->name('login.recover');


Route::get('/logged',function(){
      return view('template_auth.home.logged',
      ['user'=>Auth::user()]
      );
}) 
      ->middleware('auth')
      ->name('login.logged');






