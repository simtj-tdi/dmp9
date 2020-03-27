<?php

namespace App\Http\Controllers;

use App\Contactsus;
use App\Repositories\ContactsusRepository;
use Illuminate\Http\Request;

class ContactsusController extends Controller
{
    private $contactsusRepository;

    public function __construct(ContactsusRepository $contactsusRepository)
    {
        $this->contactsusRepository = $contactsusRepository;
    }

    public function store(Request $request)
    {
        $request_data = json_decode($request->data);

        $return_result = $this->contactsusRepository->create($request_data);

        if (!$return_result) {
            $result['result'] = "error";
            $result['error_message'] = "전송 실패";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            $result['result'] = "success";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }

}
