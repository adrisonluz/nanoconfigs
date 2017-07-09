<?php
Route::group(['middleware' => ['web']], function ($route) {
    Route::get('/login', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoLoginController@show', 'as' => 'nano.login']);
    Route::post('/login', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoLoginController@login', 'as' => 'nano.login']);
    Route::get('/logout', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoLoginController@logout', 'as' => 'nano.login']);

    Route::group(['middleware' => ['nano'], 'prefix' => 'nano', 'as' => 'nano.'], function ($route) {
        Route::get('', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@index', 'as' => 'nano.home']);
        Route::get('/', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@index', 'as' => 'nano.home']);
        Route::get('/dashboard', ['uses' => NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@index', 'as' => 'nano.home']);

        /* Rotas organizadas para usuários */
        Route::group(['prefix' => 'usuarios', 'as' => 'usuarios.', 'where' => ['id' => '[0-9]+']], function ($route) {
            Route::get('', NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@index')->name('index');
            Route::get('index', NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@index')->name('index');
            Route::get('inserir', NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@create')->name('create');
            Route::post('inserir', NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@store')->name('store');
            Route::get('{id}/editar', NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@edit')->name('edit');
            Route::post('{id}/editar', NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@update')->name('update');
            Route::get('{id}/lixeira', NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@lixeira')->name('lixeira');
            Route::get('{id}/ativar', NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@ativar')->name('ativar');
            Route::get('{id}/deletar', NanoConfigs::_PATH_CONTROLLERS . '\NanoUserController@delete')->name('delete');
        });

        /* Rotas organizadas para niveis */
    	Route::group(['prefix' => 'nivel', 'as' => 'nivel.', 'where' => ['id' => '[0-9]+']], function () {
    	    Route::post('{id}/lixeira', NanoConfigs::_PATH_CONTROLLERS . '\NanoNiveisController@lixeira')->name('lixeira');
    	    Route::post('/inserir', NanoConfigs::_PATH_CONTROLLERS . '\NanoNiveisController@store')->name('store');
    	});
    });
});