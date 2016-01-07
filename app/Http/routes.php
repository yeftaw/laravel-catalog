<?php

Route::group(['middleware' => 'web'], function () {
	Route::auth();

	Route::group(['middleware' => 'auth'], function () {
		Route::group(['middleware' => 'role:admin|customer'], function () {
			Route::get('/', [
				'as' => 'main', 'uses' => 'ProductController@index'
			]);
			Route::resource('products', 'ProductController');
		});

		Route::group(['middleware' => 'role:admin'], function () {
			Route::resource('categories', 'CategoryController');
		});
	});
});
