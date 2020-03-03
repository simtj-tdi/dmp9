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

Route::middleware(['auth', 'approved','role'])->group( function () {

    Route::get('/dashboard', 'DashBoardController@index')->name('dashboard.index');

    // 마이데이터(order)
    Route::resources(['orders' => 'OrderController']);

    // payment
    Route::post('/ajaxPayRequest', 'PaymentsController@payRequest')->name('Payments.payrequest');
    Route::post('/ajaxPayReturn', 'PaymentsController@payReturn')->name('Payments.payreturn');
    Route::get('/ajaxPayCallback', 'PaymentsController@payCallback')->name('Payments.paycallback');
    Route::get('/ajaxPayCancel', 'PaymentsController@payCancel')->name('Payments.payCancel');

    // 자주묻는질문(faq)
    Route::resources(['faqs' => 'FaqController']);

    // 문의및답변(qna)
    Route::resources(['questions' => 'QuestionController']);

    // 세금계산서요청(tax)
    Route::get('taxs', function () { return view('taxs.index'); });

    // 내정보 수정(users)
    Route::get('users', function () { return view('users.index'); });

    Route::get('users/confirm', 'UserController@confirm_index')->name('confirm_index');
    Route::post('users/confirm_check', 'UserController@confirm_check')->name('confirm_check');
    Route::get('users/my_show', 'UserController@my_show')->name('my_show');
    Route::post('users/my_update', 'UserController@my_update')->name('my_update');

    // payment_test_page
    Route::get('/payment', function () {
        return view('payment');
    })->name('Payments.index');
});
