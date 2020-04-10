<?php

namespace App\Http\Controllers;

use App\Mail\SendMailable;
use App\Repositories\TaxRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $userRepository;
    private $taxRepository;

    public function __construct(UserRepositoryInterface $userRepository, TaxRepositoryInterface $taxRepository)
    {
        $this->middleware(['auth', 'approved','role'], ['except' => ['id_check', 'SingUpFindId', 'SingUpNewPw', 'SingUpFindPassWord']]);
        $this->userRepository = $userRepository;
        $this->taxRepository = $taxRepository;
    }

    // 마이정보-패스워드입력 화면
    public function confirm_index()
    {
        return view('users.confirm_index');
    }

    // 마이정보-비밀번호체크
    public function confirm_check(Request $request)
    {
        $request_data = json_decode($request->data);

        $result['result'] = "success";

        if (!$this->userRepository->password_check($request_data)) {
            $result['result'] = "error";
            $result['error_message'] = "패스워드를 다시 입력 해주세요.";
        }

        $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

        return $response;
    }

    // 마이정보-수정입력 화면
    public function my_show()
    {
        $user = $this->userRepository->findById();
        $taxs = $user->taxes;

        if (!is_array($taxs)) {
            $taxs[] = '';
        }

        return view('users.company', compact('user','taxs'));
    }

    public function file_download($file_name)
    {
        $path = storage_path(). "/app/tax/".auth()->user()->user_id."/".$file_name;

        return response()->download($path);
    }

    // 마이정보-수정 업데이트
    public function my_update(Request $request)
    {
        $request['password'] = $this->userRepository->makePassword($request['password']);

        $this->userRepository->update($request);

//        if ($request['type'] == "company") {
//            $this->taxRepository->update($request);
//        }

        return redirect('users');
    }

    // 회원가입-아이디체크
    public function id_check(Request $request)
    {
        $user_id = $this->userRepository->findByUserId($request->data);
        $result = response()->json(['result'=> $user_id], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

        return $result;
    }

    // 아이디 찾기
    public function SingUpFindId(Request $request)
    {
        $request_data = json_decode($request->data);
        $return_result = $this->userRepository->SingUpFindId($request_data);

        if (empty($return_result[0])) {
            $result['result'] = "error";
            $result['error_message'] = "전송 실패";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            $result['result'] = "success";
            $result['result_info'] = $return_result;
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }

    public function SingUpFindPassWord(Request $request)
    {
        $request_data = json_decode($request->data);
        $return_result = $this->userRepository->SingUpFindById($request_data);

        if (empty($return_result[0])) {
            $result['result'] = "error";
            $result['error_message'] = "전송 실패";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            Mail::to($return_result[0]['email'])->send(new SendMailable($return_result[0]));

            $result['result'] = "success";
            $result['result_info'] = $return_result;
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }

    public function SingUpNewPw(Request $request)
    {
        $request_data = json_decode($request->data);
        $return_result = $this->userRepository->SingUpNewPw($request_data);

        if (!$return_result) {
            $result['result'] = "error";
            $result['error_message'] = "전송 실패";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            $result['result'] = "success";
            $result['result_info'] = $return_result;
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }
}
