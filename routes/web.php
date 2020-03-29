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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {return view('welcome');});

Auth::routes();

// 회원가입
Route::get('/sign_up_type', function() { return view('sign.sign_up_type');});
Route::post('/sign_up_terms', function(\Illuminate\Http\Request $request) {
    return view('sign.sign_up_terms', compact('request'));
});
Route::post('/sign_up_register', function(\Illuminate\Http\Request $request) {
    return view('sign.sign_up_register', compact('request'));
});
Route::post('/sign_up_register_company', function(\Illuminate\Http\Request $request) {
    return view('sign.sign_up_register_company', compact('request'));
});

Route::get('/sign_up_type', function() {
    return view('sign.sign_up_type');
});

Route::get('/sign_up_find_id', function() {
    return view('sign.sign_up_find_id');
});

Route::get('/sign_up_find_pw', function() {
    return view('sign.sign_up_find_pw');
});

Route::post('/sign_up_find_new_pw', function() {
    return view('sign.sign_up_find_new_pw');
});

Route::get('/sign_up_finish_sign_up', function() {
    return view('sign.sign_up_finish_sign_up');
});

Route::post('/ajaxIdCheckRequest', 'UserController@id_check')->name('Users.idcheckrequest');
Route::post('/ajaxSignUpFindId', 'UserController@SingUpFindId')->name('Users.SingUpFindId');
Route::post('/ajaxSingUpNewPw', 'UserController@SingUpNewPw')->name('Users.SingUpNewPw');


// 인증 예외 처리
Route::get('/approved', function() {
    Auth::logout();
    return view('approved');
})->name('approved');

// 권한 예외 처리
Route::get('/role', function() {
    Auth::logout();
    return view('role');
})->name('role');

Route::post('/ajaxContactusCreate', 'ContactsusController@store')->name('Contactsus.create');

Route::middleware(['auth', 'approved','role'])->group( function () {

    Route::get('/dashboard', 'DashBoardController@index')->name('dashboard.index');

    // 마이데이터(order)
    Route::resource('goods' , 'GoodsController');
    Route::resource('carts' , 'CartController');

    // 마이데이터 플랫폼(option)
    Route::post('/ajaxOptionAdd','OptionController@optionAdd')->name('Option.add');
    Route::post('/ajaxOptionSave','OptionController@optionSave')->name('Option.save');
    Route::post('/ajaxOptionUploadRequest','OptionController@optionUploadRequest')->name('Option.updateload');

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
    Route::post('my_show', 'UserController@my_show')->name('my_show');
    Route::post('my_update', 'UserController@my_update')->name('my_update');


    // 주문내역
    Route::get('/history', 'OrderController@history')->name('orders_history');
    Route::post('/ajaxTaxState', 'OrderController@taxstate')->name('tax_state');

    // payment_test_page
    Route::get('/payment', function () {
        return view('payment');
    })->name('Payments.index');
});
