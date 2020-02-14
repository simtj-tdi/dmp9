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
    Route::get('/market', 'MarketController@index')->name('market.index');
    Route::get('/mydate', 'MyDateController@index')->name('mydate.index');

    Route::group(['prefix' => 'mypage'], function () {
        Route::get('/', 'MyPageController@index')->name('mypage.index');
        Route::get('faq', 'MyPageController@faq_index')->name('mypage.faq.index');
        Route::get('create', 'MyPageController@faq_create')->name('mypage.faq.create');
        Route::post('store','MyPageController@faq_store')->name('mypage.faq.store');
        Route::get('{id}','MyPageController@faq_show')->name('mypage.faq.show');
        Route::put('{id}','MyPageController@faq_update')->name('mypage.faq.update');
        Route::delete('{id}','MyPageController@faq_destroy')->name('mypage.faq.destroy');
    });

});


