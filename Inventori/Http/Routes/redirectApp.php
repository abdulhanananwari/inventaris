<?php

Route::group(['prefix' => 'redirect-angular'], function(){

	Route::get('inventori/{id}', function($id) {
		return redirect()->to('/angular/Inventori/index.html#/inventori/show/' . $id);
	});
});