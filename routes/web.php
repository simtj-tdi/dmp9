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

/*
 * TODO : route 재정의 fap controller 생성 및 resource 사용
 * https://laravel.kr/docs/6.x/controllers
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group( function () {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');

    Route::get('/dashboard', 'DashBoardController@index')->name('dashboard.index');
    Route::get('/market', 'MarketController@index')->name('market.index');
    Route::get('/mydate', 'MyDateController@index')->name('mydate.index');

    Route::group(['prefix' => 'mypage'], function () {
        Route::get('/', 'MyPageController@index')->name('mypage.index');

        /* 마이페이지 자주 묻는 질문 (faq)  */
        //Route::middleware(['permission:faq-list|faq-create|faq-delete'])->group( function () {

        Route::get('faq', 'MyPageController@faq_index')->name('mypage.faq.index')->middleware('permission:faq-list');
        Route::get('create', 'MyPageController@faq_create')->name('mypage.faq.create')->middleware('permission:faq-create');;
        Route::post('store','MyPageController@faq_store')->name('mypage.faq.store')->middleware('permission:faq-create');;
        Route::get('faq/{id}','MyPageController@faq_show')->name('mypage.faq.show')->middleware('permission:faq-edit');;
        Route::put('faq/{id}','MyPageController@faq_update')->name('mypage.faq.update')->middleware('permission:faq-edit');;
        Route::delete('faq/{id}','MyPageController@faq_destroy')->name('mypage.faq.destroy')->middleware('permission:faq-delete');;

        //});

        /* 마이페이지 내정보 수정 */
        Route::get('confirm', 'MyPageController@my_confirm')->name('mypage.confirm');
        Route::post('confirm_check', 'MyPageController@my_confirm_check')->name('mypage.confirm.check');
        Route::get('info', 'MyPageController@my_info_show')->name('mypage.info.show');
        Route::post('update', 'MyPageController@my_info_update')->name('mypage.info.update');
    });
});


