<?php

Route::group(['middleware' => 'web'], function () {
	Route::auth();

	Route::group(['middleware' => 'auth'], function () {
		Route::group(['middleware' => 'role:admin'], function () {
			Route::resource('products', 'ProductController', ['except' => 'show']);
			Route::resource('categories', 'CategoryController', ['except' => 'show']);
		});

		Route::group(['middleware' => 'role:admin|customer'], function () {
			Route::get('/', [
				'as' => 'main', 'uses' => 'ProductController@index'
			]);
		});
	});

});
