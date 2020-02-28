<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Payment_return;
use App\Payment_fail;

class PaymentsController extends Controller
{
    public function payRequest(Request $request)
    {
        $strUrl = 'https://testpgapi.payletter.com/v1.0/payments/request';

        $strPostData = '{
            "pgcode"            : "creditcard",
            "user_id"           : "'.auth()->user()->id.'",
            "user_name"         : "'.mb_convert_encoding(auth()->user()->name, "EUC-KR", "UTF-8").'",
            "service_name"      : "dmp9",
            "client_id"         : "pay_test",
            "order_no"          : "123456",
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


        $arrHeaderData   = [];
        $arrHeaderData[] = 'Content-Type: application/json';
        $arrHeaderData[] = 'Authorization: PLKEY MTFBNTAzNTEwNDAxQUIyMjlCQzgwNTg1MkU4MkZENDA=';
        $objCurl = curl_init();
        curl_setopt($objCurl, CURLOPT_URL, $strUrl);
        curl_setopt($objCurl, CURLOPT_HTTPHEADER, $arrHeaderData);
        curl_setopt($objCurl, CURLOPT_POST, 1);
        curl_setopt($objCurl, CURLOPT_POSTFIELDS, iconv("euc-kr", "utf-8", $strPostData));
        curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, true);

        $strResponse   = curl_exec($objCurl);

        if(curl_getinfo($objCurl, CURLINFO_HTTP_CODE) == 200) {
            curl_close($objCurl);

            return response()->json(['success'=> $strResponse], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            curl_close($objCurl);
            return response()->json(['error'=> $strResponse]);
        }
    }

    public function payReturn(Request $request)
    {

        $colleect = collect($request)->map(function ($value, $key) {
            return $value;
        });

        if ($colleect['code'] == 0) {
            $payment_id = Payment_return::create($colleect->toArray());
//            $payment_id->id;
            $custom_parameter = $colleect['custom_parameter'];

        } else {
            Payment_fail::create($colleect->toArray());
        }

        return redirect()->route('Payments.paycallback');
    }

    public function payCallback(Request $request)
    {
        // 결제가 성공한 경우에만 결제 결과가 json형태로 제공됩니다.
        //*Callback URL로 전달되는 현금영수증 데이터의 경우 하기와 같은 형태로 제공 됩니다
        //https://www.payletter.com/ko/technical/index#ab21eea6c1
        //dd($request);
    }

    public function payCancel(Request $request)
    {
        dd($request);
    }
}
