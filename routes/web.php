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

    // 마이데이터(order)
    Route::get('orders', function () { return view('orders.index'); });

    // 자주묻는질문(faq)
    Route::resources(['faqs' => 'FaqController']);

    // 문의및답변(qna)
    Route::get('qnas', function () { return view('qnas.index'); });

    // 세금계산서요청(tax)
    Route::get('taxs', function () { return view('taxs.index'); });

    // 내정보 수정(users)
    Route::get('users', function () { return view('users.index'); });

    // 충전 내역(costs)


    Route::get('/dashboard', 'DashBoardController@index')->name('dashboard.index');

    Route::get('/payment', function () {
        return view('payment');
    })->name('Payments.index');

    Route::post('/ajaxPayRequest', 'PaymentsController@payRequest')->name('Payments.payrequest');
    Route::post('/ajaxPayReturn', 'PaymentsController@payReturn')->name('Payments.payreturn');
    Route::get('/ajaxPayCallback', 'PaymentsController@payCallback')->name('Payments.paycallback');
    Route::get('/ajaxPayCancel', 'PaymentsController@payCancel')->name('Payments.payCancel');


    Route::get('users/confirm', 'UserController@confirm_index')->name('confirm_index');
    Route::post('users/confirm_check', 'UserController@confirm_check')->name('confirm_check');
    Route::get('users/my_show/{id}', 'UserController@my_show')->name('my_show');
    Route::post('users/my_update', 'UserController@my_update')->name('my_update');

    Route::resources([
        'roles' => 'RoleController',
        'users/roles' => 'UserRolesController',
    ]);

});


