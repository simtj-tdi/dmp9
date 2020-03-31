<?php

namespace App\Http\Controllers;


use App\Repositories\OrderRepositoryInterface;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function history()
    {
        $orders = $this->orderRepository->all();

        if (auth()->user()->role == "personal") {
            $txt = "영수증";
        } else if (auth()->user()->role == "company") {
            $txt = "계산서";
        }

        return view('orders.history', compact('orders', 'txt'));
    }

    public function taxstate(Request $request)
    {
        $request_data = json_decode($request->data);

        $return_result = $this->orderRepository->taxstate_update($request_data);

        if (!$return_result) {
            $result['result'] = "error";
            $result['error_message'] = "등록되어 있는 계산서가 없습니다.";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            $result['result'] = "success";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }
}
