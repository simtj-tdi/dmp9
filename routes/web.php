<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group( function () {

    Route::get('/dashboard', 'DashBoardController@index')->name('dashboard.index');

    Route::get('users/confirm', 'UserController@confirm_index')->name('confirm_index');
    Route::post('users/confirm_check', 'UserController@confirm_check')->name('confirm_check');
    Route::get('users/my_show/{id}', 'UserController@my_show')->name('my_show');
    Route::post('users/my_update', 'UserController@my_update')->name('my_update');

    Route::resources([
        'roles' => 'RoleController',
        'users/roles' => 'UserRolesController',
        'mypage/faqs' => 'FaqController',
    ]);

});


