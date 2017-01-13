<?php

$middleware = ['wala.jwt.request.parser', 'wala.jwt.request.validation', 'auth.db.overwrite', 'auth.req.tenantIdOverwrite'];

Route::group(['prefix' => "report", 'namespace' => 'Report', 'middleware' => $middleware], function() {

    Route::group([ 'prefix' => 'inventori'], function() {
        Route::get('/', ['uses' => 'InventoriController@index', 'middleware' => 'auth.jwt_tumr:LIHAT_INVENTORI']);
    });

});
