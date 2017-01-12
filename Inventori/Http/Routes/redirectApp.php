<?php

Route::group(['prefix' => 'redirect-angular'], function(){

	Route::get('inventori/{id}', function($id) {
		return redirect()->to('/Angular/Inventori/index.html#/inventori/show/' . $id);
	});
});