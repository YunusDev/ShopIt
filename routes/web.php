<?php


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/test', 'HomeController@test');

Route::group(['namespace'=>'User'], function() {

    Route::get('/product/{slug}', 'ProductController@show')->name('single');

    Route::get('/cart', 'ProductController@cart')->name('cart');

    Route::post('/product', 'ProductController@addToCart')->name('addToCart');

    Route::post('/edit/cart', 'ProductController@updateItemCart')->name('editToCart');

    Route::post('/remove/product/cart', 'ProductController@deleteItemCart')->name('remToCart');

});

Route::group(['namespace'=>'Admin', 'prefix'=>'admin'], function() {

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');

    Route::post('/login', 'Auth\LoginController@login');

    Route::group(['middleware' => 'auth:admin'], function() {

        Route::post('/logout',  'Auth\LoginController@logout');

        Route::get('/users', 'UsersController@index')->name('users.index');

        Route::delete('/users/delete/{id}', 'UsersController@delete')->name('users.destroy');

        Route::get('/home', 'HomeController@index')->name('admin.home');

        Route::resource('/admins', 'AdminUsersController');

        Route::resource('/admins', 'AdminUsersController');

        Route::resource('/role', 'RoleController');

        Route::resource('/permission', 'PermissionController');

        Route::resource('/category', 'CategoryController');

        Route::resource('/product', 'ProductController');


    });
});
