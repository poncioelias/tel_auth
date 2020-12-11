<?php



use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Api;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// // Route::group(['namespace'=> 'App\Http\Controllers\Api','as'=>'.api'], function(){

// //     Route::apiResource('/user','UserController');
// // });

// Route::middleware('auth:api')->get('/user',function(Request $request){
//     return 'kassio';
// });


Route::apiResource('/user','App\Http\Controllers\Api\UserController');
