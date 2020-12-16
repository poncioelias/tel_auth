<?php
/*
 * Descomentado linha 29 no arquivo Providers/RouteServiceProvider.php
 * para acesso a forma antiga de gerar as rotas
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 



Route::get('/',function(){  return redirect('login'); });

Route::get('/session/',function(){  return redirect('login'); });

Route::get('/session/{uri}',function(Request $request){
  //retorna os dados da sessao
  $session = session()->get($request->uri);
 
  if( empty( $session) )
    return redirect('login');
  else
    echo json_encode( $session, JSON_UNESCAPED_UNICODE );


  //retorna as permissoes
  //  $p = \App\Models\PermissionsModel::permissions($request->uri); 
  //  echo json_encode( $p, JSON_UNESCAPED_UNICODE );
});

Route::post('/modal/doubt','ModalController@doubt')->name('modal.doubt');

Route::get('/login/{id_system?}','LoginController@index')->name('login.home');
Route::post('/login','LoginController@store')->name('login.do');

Route::post('/register','LoginController@register')->name('register');
Route::post('/user/verify','LoginController@userVerify')->name('user.verify');



Route::get('/redefinicao','LoginController@resetpasswd')->name('resetpasswd');
Route::post('/recover','LoginController@recover')->name('recover');






