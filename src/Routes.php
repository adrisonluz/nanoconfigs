<?php
Route::get('/login', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoLoginController@showLoginForm', 'as' => 'nano.login']);

Route::group(['middleware' => ['web','nano'], 'prefix' => 'nano'], function () {
    /* Rotas organizadas para usuários */
    Route::group(['prefix' => 'usuarios', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@index', 'as' => 'nano.usuarios.index']);
        Route::get('index', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@index', 'as' => 'nano.usuarios.index']);
        Route::get('inserir', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@create', 'as' => 'nano.usuarios.create']);
        Route::post('inserir', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@store', 'as' => 'nano.usuarios.store']);
        Route::get('{id}/editar', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@edit', 'as' => 'nano.usuarios.edit']);
        Route::post('{id}/editar', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@update', 'as' => 'nano.usuarios.update']);
        Route::get('{id}/lixeira', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@lixeira', 'as' => 'nano.usuarios.lixeira']);
        Route::get('{id}/ativar', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@ativar', 'as' => 'nano.usuarios.ativar']);
        Route::get('{id}/deletar', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@delete', 'as' => 'nano.usuarios.delete']);
    });

    /* Rotas organizadas para niveis */
	Route::group(['prefix' => 'nivel', 'where' => ['id' => '[0-9]+']], function () {
	    Route::post('{id}/lixeira', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoNiveisController@lixeira', 'as' => 'nivel.lixeira']);
	    Route::post('/inserir', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoNiveisController@store', 'as' => 'nivel.store']);
	});
});