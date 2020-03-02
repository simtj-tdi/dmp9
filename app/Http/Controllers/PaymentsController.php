<?php

namespace App\Http\Controllers;

use App\Pay_log;
use Illuminate\Http\Request;
use App\Payment_return;
use App\Payment_fail;
use App\Order;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PaymentsController extends Controller
{
    public function payRequest(Request $request)
    {

        $order_no = IdGenerator::generate(['table' => 'orders', 'field'=>'order_no','length' => 12, 'prefix' => date('Ymd')]);
        $strUrl = 'https://testpgapi.payletter.com/v1.0/payments/request';

        $strPostData = '{
            "pgcode"            : "creditcard",
            "user_id"           : "'.auth()->user()->id.'",
            "user_name"         : "'.mb_convert_encoding(auth()->user()->name, "EUC-KR", "UTF-8").'",
            "service_name"      : "dmp9",
            "client_id"         : "pay_test",
            "order_no"          : "'.$order_no.'",
            "amount"            : "'.$request['data'][3].'",
            "product_name"      : "'.mb_convert_encoding($request['data'][1], "EUC-KR", "UTF-8").'",
            "email_flag"        : "Y",
            "email_addr"        : "'.auth()->user()->email.'",
            "autopay_flag"      : "N",
            "receipt_flag"      : "Y",
            "custom_parameter"  : "'.mb_convert_encoding(implode("|", $request['data']), "EUC-KR", "UTF-8").'",
            "return_url"        : "'.route('Payments.payreturn').'",
            "callback_url"      : "'.route('Payments.paycallback').'",
            "cancel_url"        : "'.route('Payments.payCancel').'",
        }';
        /* iconv(): Detected an illegal character in input string 오류로 인해 mb_convert_encoding 사용 */

        $arrHeaderData   = [];
        $arrHeaderData[] = 'Content-Type: application/json';
        $arrHeaderData[] = 'Authorization: PLKEY MTFBNTAzNTEwNDAxQUIyMjlCQzgwNTg1MkU4MkZENDA=';
        $objCurl = curl_init();
        curl_setopt($objCurl, CURLOPT_URL, $strUrl);
        curl_setopt($objCurl, CURLOPT_HTTPHEADER, $arrHeaderData);
        curl_setopt($objCurl, CURLOPT_POST, 1);
        curl_setopt($objCurl, CURLOPT_POSTFIELDS, iconv("euc-kr", "utf-8", $strPostData));
        curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, true);
        /* error: "{"code":997,"message":"지정한 코드 페이지의 367 인덱스에서 바이트 [C5]을(를) 유니코드로 변환할 수 없습니다."}" 오류로 인해 iconv 사용 */
        $strResponse   = curl_exec($objCurl);

        if(curl_getinfo($objCurl, CURLINFO_HTTP_CODE) == 200) {
            curl_close($objCurl);
            Order::find($request['data'][0])->update(['order_no'=> $order_no]);
            $this->pay_log("payRequest", iconv("euc-kr", "utf-8", $strPostData));
            return response()->json(['success'=> $strResponse], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            curl_close($objCurl);
            return response()->json(['error'=> $strResponse]);
        }
    }

    public function payReturn(Request $request)
    {
        $this->pay_log("payReturn", urldecode($request));
        $colleect = collect($request)->map(function ($value, $key) {
            return $value;
        });

        if ($colleect['code'] == 0) {
            $payment = Payment_return::create($colleect->toArray());
            Order::where('order_no', $payment->order_no)
                ->update(['payment_id'=> $payment->id, 'state' => 2]);

        } else {
            Payment_fail::create($colleect->toArray());
        }

        return view('payment.payreturn');
    }

    public function payCallback(Request $request)
    {
        // 결제가 성공한 경우에만 결제 결과가 json형태로 제공됩니다.
        //*Callback URL로 전달되는 현금영수증 데이터의 경우 하기와 같은 형태로 제공 됩니다
        //https://www.payletter.com/ko/technical/index#ab21eea6c1
    }

    public function payCancel(Request $request)
    {
        $this->pay_log("payCancel", urldecode($request));
        return view('payment.paycancel');
    }

    public function pay_log($state, $message)
    {
        $pay_log['user_id'] = auth()->user()->id;
        $pay_log['state'] = $state;
        $pay_log['message'] = $message;

        Pay_log::create($pay_log);
    }

}
