<?php

namespace App\Http\Controllers;

use App\Repositories\CartRepositoryInterface;
use App\Repositories\GoodsRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\PaymentRepositoryInterface;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PaymentsController extends Controller
{
//    private $check = true;
    private $cartRepository;
    private $goodsRepository;
    private $orderRepository;
    private $paymentRepository;

    private $strPostData;

    public function __construct(
            CartRepositoryInterface $cartRepository,
            GoodsRepositoryInterface $goodsRepository,
            OrderRepositoryInterface $orderRepository,
            PaymentRepositoryInterface $paymentRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->goodsRepository = $goodsRepository;
        $this->orderRepository = $orderRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function payRequest(Request $request)
    {

        /**
         *   $check = false;
         *   if($check === false) rollback;
         *   //log insert
         *   $msg = '';
         *   return ;
         */

        $request_data = json_decode($request->data);

        // 상품 체크 및 가격 확인
        $goods = $this->goodsRepository->findByIds($request_data->ids);

        if ($goods->isEmpty()) {
            $strResponse = response()->json(['error'=> 'error', 'message'=>'구매 데이터의 가격을 다시 확인 해주세요.' ], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
            return $strResponse;
        }

        if ($request_data->total_price != $goods->sum('buy_price')) {
            $strResponse = response()->json(['error'=> 'error', 'message'=>'구매 데이터의 가격을 다시 확인 해주세요.' ], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
            return $strResponse;
        }

        // PG 데이터 생성
        $pay_data['count'] = $request_data->total_count ;
        $pay_data['amount'] = $request_data->total_price ;
        $pay_data['product_name'] = ($goods->count() > 1) ?
                                            $goods[0]->data_name ."외 ". ((int)$goods->count()-1) . "개" :
                                            $goods[0]->data_name;
        $pay_data['goods_info'] = json_encode($goods, JSON_UNESCAPED_UNICODE) ;

        // 주문번호 생성
        $order_no = $this->makeOrderNo();

        // PG Response
        $this->makeStrPostDate($order_no, $pay_data);
        $curl_getinfo = $this->curlTransfer();

        $this->cartRepository->updateOrder_no($request_data->ids, $order_no);
        $this->orderRepository->create($order_no, $pay_data);

        return $curl_getinfo;
    }

    public function payReturn(Request $request)
    {
        if ($request->code == 0) {
            $this->paymentRepository->payReturn($request);
            $payment = $this->paymentRepository->findByOrder($request->order_no);

            // 결제 정상 완료 시
            // order state update
            $this->orderRepository->state_update($request->order_no, $payment->id);
            // cart state update
            $this->cartRepository->buydate_update($request->order_no, $payment->transaction_date);

            $this->paymentRepository->payLog("payReturn", urldecode($request));
        } else {
//            Payment_fail::create($colleect->toArray());
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
        $this->paymentRepository->payLog("payCancel", urldecode($request));
        return view('payment.paycancel');
    }

    public function makeOrderNo()
    {
        return IdGenerator::generate(['table' => 'orders', 'field'=>'order_no','length' => 12, 'prefix' => date('Ymd')]);
    }

    public function makeStrPostDate($order_no, $pay_data)
    {
        $strPostData = '{
            "pgcode"            : "creditcard",
            "user_id"           : "'.auth()->user()->id.'",
            "user_name"         : "'.mb_convert_encoding(auth()->user()->name, "EUC-KR", "UTF-8").'",
            "service_name"      : "dmp9",
            "client_id"         : "pay_test",
            "order_no"          : "'.$order_no.'",
            "amount"            : "'.$pay_data['amount'].'",
            "product_name"      : "'.mb_convert_encoding($pay_data['product_name'], "EUC-KR", "UTF-8").'",
            "email_flag"        : "Y",
            "email_addr"        : "'.auth()->user()->email.'",
            "autopay_flag"      : "N",
            "receipt_flag"      : "Y",
            "custom_parameter"  : "",
            "return_url"        : "'.route('Payments.payreturn').'",
            "callback_url"      : "'.route('Payments.paycallback').'",
            "cancel_url"        : "'.route('Payments.payCancel').'",
        }';
        /* iconv(): Detected an illegal character in input string 오류로 인해 mb_convert_encoding 사용 */

        $this->strPostData = $strPostData;
    }

    public function curlTransfer()
    {
        $strUrl = 'https://testpgapi.payletter.com/v1.0/payments/request';

        $arrHeaderData   = [];
        $arrHeaderData[] = 'Content-Type: application/json';
        $arrHeaderData[] = 'Authorization: PLKEY MTFBNTAzNTEwNDAxQUIyMjlCQzgwNTg1MkU4MkZENDA=';
        $objCurl = curl_init();
        curl_setopt($objCurl, CURLOPT_URL, $strUrl);
        curl_setopt($objCurl, CURLOPT_HTTPHEADER, $arrHeaderData);
        curl_setopt($objCurl, CURLOPT_POST, 1);
        curl_setopt($objCurl, CURLOPT_POSTFIELDS, iconv("euc-kr", "utf-8", $this->strPostData));
        curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, true);
        /* error: "{"code":997,"message":"지정한 코드 페이지의 367 인덱스에서 바이트 [C5]을(를) 유니코드로 변환할 수 없습니다."}" 오류로 인해 iconv 사용 */
        $strResponse = curl_exec($objCurl);

        if(curl_getinfo($objCurl, CURLINFO_HTTP_CODE) == 200) {
            // 결제 창 정상 호출 시
            $this->paymentRepository->payLog("curlTransfer", urldecode($strResponse));
            $strResponse = response()->json(['success'=> $strResponse], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            $strResponse = response()->json(['error'=> $strResponse]);
        }

        curl_close($objCurl);

        return $strResponse;
    }
}
