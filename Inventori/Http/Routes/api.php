<?php

$middleware = ['wala.jwt.header.parser', 'wala.jwt.header.validation', 'auth.db.overwrite', 'auth.req.tenantIdOverwrite'];

Route::group(['prefix' => "api", 'middleware' => $middleware], function() {

    Route::group(['namespace' => 'Api', 'prefix' => 'location',], function() {

        Route::get('/', ['uses' => 'LocationController@index', 'middleware' => 'auth.jwt_tumr:LIHAT_LOKASI']);
        Route::get('{id}', ['uses' => 'LocationController@get', 'middleware' => 'auth.jwt_tumr:LIHAT_LOKASI']);
        Route::post('/', ['uses' => 'LocationController@store', 'middleware' => 'auth.jwt_tumr:EDIT_LOKASI']);
        Route::post('{id}', ['uses' => 'LocationController@update', 'middleware' => 'auth.jwt_tumr:EDIT_LOKASI']);
        Route::delete('{id}', ['uses' => 'LocationController@destroy']);
    });

    Route::group(['namespace' => 'Api', 'prefix' => 'inventori'], function() {

        Route::get('/', ['uses' => 'InventoriController@index', 'middleware' => 'auth.jwt_tumr:LIHAT_INVENTORI']);
        Route::get('{id}', ['uses' => 'InventoriController@get', 'middleware' => 'auth.jwt_tumr:LIHAT_INVENTORI']);
        Route::get('uuid/{id}', ['uses' => 'InventoriController@generate', 'middleware' => 'auth.jwt_tumr:LIHAT_INVENTORI']);
        Route::post('/', ['uses' => 'InventoriController@store', 'middleware' => 'auth.jwt_tumr:EDIT_INVENTORI']);
        Route::post('{id}', ['uses' => 'InventoriController@update', 'middleware' => 'auth.jwt_tumr:EDIT_INVENTORI']);
        Route::delete('{id}', ['uses' => 'InventoriController@destroy']);
    });

    Route::group(['namespace' => 'Api', 'prefix' => 'maintenanceInventori'], function() {

        Route::get('/', ['uses' => 'MaintenanceInventoriController@index', 'middleware' => 'auth.jwt_tumr:LIHAT_MAINTENANCE_INVENTORI']);
        Route::get('{id}', ['uses' => 'MaintenanceInventoriController@get', 'middleware' => 'auth.jwt_tumr:LIHAT_MAINTENANCE_INVENTORI']);
        Route::post('/', ['uses' => 'MaintenanceInventoriController@store', 'middleware' => 'auth.jwt_tumr:EDIT_MAINTENANCE_INVENTORI']);
        Route::post('{id}', ['uses' => 'MaintenanceInventoriController@update', 'middleware' => 'auth.jwt_tumr:EDIT_MAINTENANCE_INVENTORI']);
        Route::delete('{id}', ['uses' => 'MaintenanceInventoriController@destroy']);
    });
    Route::group(['namespace' => 'Api', 'prefix' => 'checkInventori'], function() {

        Route::get('/', ['uses' => 'CheckInventoriController@index']);
        Route::get('{id}', ['uses' => 'CheckInventoriController@get']);
        Route::post('/', ['uses' => 'CheckInventoriController@store']);
        Route::post('{id}', ['uses' => 'CheckInventoriController@update']);
        Route::delete('{id}', ['uses' => 'CheckInventoriController@destroy']);
    });

    Route::group(['namespace' => 'Api', 'prefix' => 'config'], function() {

        Route::get('{name}', ['uses' => 'ConfigController@get']);
    });
});
