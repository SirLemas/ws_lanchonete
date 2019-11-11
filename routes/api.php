<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/usuarios', 'Api\UsuariosController@cadastrar');
Route::post('/login', 'Api\UsuariosController@logar');


Route::group(['middleware' => ['jwt']], function() {
    Route::group(['prefix' => 'cardapio'], function() {
        Route::get('/', 'Api\CardapiosController@listar');
        Route::get('/{id}', 'Api\CardapiosController@buscar');
        Route::post('/', 'Api\CardapiosController@cadastrar');
        Route::put('/{id}', 'Api\CardapiosController@atualizar');
        Route::delete('/{id}', 'Api\CardapiosController@deletar') ;
    });
});
