<?php

Route::group(['namespace' => '\Inventori\Http\Controllers'], function() {
    include('Routes/api.php');
    include('Routes/trigger.php');
});
