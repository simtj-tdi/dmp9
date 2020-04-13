<?php

namespace App\Http\Controllers;


use App\Repositories\UserRepositoryInterface;
use App\Sms\SMS;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function SmsSend(Request $request)
    {
        $request_data = json_decode($request->data);


        $phone_info = $this->userRepository->findByPhone($request_data->phone);

        if (isset($phone_info[0])) {

            $result['result'] = "error";
            $result['error_message'] = "등록되어 있는 연락처 입니다.";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

            return $response;
        }

        // random 값 생성
        $r = rand(100000, 999999);

        $sms_info['sessionid'] = session()->getId();
        $sms_info['phone'] = $request_data->phone;
        $sms_info['token'] = $r;
        $sms_info['auth'] = "N";

        $snd_number = "07041381644"; //trim($s_s_phone);  //보내는 번호
        $rcv_number = $request_data->phone;    //받는 번호
        $sms_content = "[ " . $r . " ] 본인확인 인증번호를 입력하세요! [DMP9]";

        /******고객님 접속 정보************/
        $sms_id = "nsmg21";            //고객님께서 부여 받으신 sms_id
        $sms_pwd = "106683ab";       //고객님께서 부여 받으신 sms_pwd
//        $sms_id = "oranc21";            //고객님께서 부여 받으신 sms_id
//        $sms_pwd = "502192";       //고객님께서 부여 받으신 sms_pwd

        $callbackURL = "sms.tongkni.co.kr";
        $userdefine = $sms_id;         //예약취소를 위해 넣어주는 구분자 정의값, 사용자 임의로 지정해주시면 됩니다. 영문으로 넣어주셔야 합니다. 사용자가 구분할 수 있는 값을 넣어주세요.
        $canclemode = "1";                //예약 취소 모드 1: 사용자정의값에 의한 삭제.  현제는 무조건 1을 넣어주시면 됩니다.
        //구축 테스트 주소와 일반 웹서비스 선택
        if (substr($sms_id, 0, 3) == "bt_") {
            $webService = "http://webservice.tongkni.co.kr/sms.3.bt/ServiceSMS_bt.asmx?WSDL";
        } else {
            $webService = "http://webservice.tongkni.co.kr/sms.3/ServiceSMS.asmx?WSDL";
        }

        $sms = new SMS($webService); //SMS 객체 생성
        $return_result = $sms->SendSMS($sms_id, $sms_pwd, $snd_number, $rcv_number, $sms_content);// 5개의 인자로 함수를 호출합니다.

        if ($return_result) {
            $sms_result = \App\Sms::create($sms_info);

            if (!$sms_result) {
                $result['result'] = "error";
                $result['error_message'] = "전화번호를 다시 확인 해주세요.";
                $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

            } else {
                $result['result'] = "success";
                $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
            }

            return $response;
        } else {
            return -9001;
        }


    }

    public function SmsCheck(Request $request)
    {
        $request_data = json_decode($request->data);

        $sms_info['sessionid'] = session()->getId();
        $sms_info['phone'] = $request_data->phone;
        $sms_info['token'] = $request_data->token;
        $sms_info['auth'] = "N";

        $sms_result = \App\Sms::where('sessionid', session()->getId())
            ->where('phone', $request_data->phone)
            ->where('auth', 'N')
            ->orderby('id', 'desc')
            ->first();

        if (strtotime(date("Y-m-d H:i:s")) - strtotime($sms_result->created_at) >= 180) {
            $result['result'] = "error";
            $result['error_message'] = "인증번호가 만료되었습니다.";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

            return $response;
        }

        if ($sms_result->token != $sms_info['token']) {
            $result['result'] = "error";
            $result['error_message'] = "인증번호를 다시 확인 해주세요.";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

        } else {
            $sms_result->update(['auth'=>'Y']);
            $result['result'] = "success";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }


}
