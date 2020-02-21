<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentsController extends Controller
{
    public function payRequest(Request $request)
    {
        $strUrl = 'https://testpgapi.payletter.com/v1.0/payments/request';

        $strPostData = '{
        "pgcode"            : "'.$request['pgcode'].'",
        "user_id"           : "'.$request['user_id'].'",
        "user_name"         : "'.mb_convert_encoding($request['user_name'], "EUC-KR", "UTF-8").'",
        "service_name"      : "'.mb_convert_encoding($request['service_name'], "EUC-KR", "UTF-8").'",
        "client_id"         : "'.$request['client_id'].'",
        "order_no"          : "'.$request['order_no'].'",
        "amount"            : '.$request['amount'].',
        "product_name"      : "'.mb_convert_encoding($request['product_name'], "EUC-KR", "UTF-8").'",
        "email_flag"        : "'.$request['email_flag'].'",
        "email_addr"        : "'.$request['email_addr'].'",
        "autopay_flag"      : "'.$request['autopay_flag'].'",
        "receipt_flag"      : "'.$request['receipt_flag'].'",
        "custom_parameter"  : "'.$request['custom_parameter'].'",
        "return_url"        : "'.$request['return_url'].'",
        "callback_url"      : "'.$request['callback_url'].'",
        "cancel_url"        : "'.$request['cancel_url'].'",
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
        dd($request);
        return redirect()->route('Payments.paycallback');
    }

    public function payCallback(Request $request)
    {
        dd($request);

    }

    public function payCancel(Request $request)
    {
        dd($request);
    }
}
