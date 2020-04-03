<?php

namespace App\Http\Controllers;

use App\Repositories\CartRepositoryInterface;
use App\Repositories\PlatformRepositoryInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartRepository;
    private $platformRepository;

    public function __construct(CartRepositoryInterface $cartRepository, PlatformRepositoryInterface $platformRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->platformRepository = $platformRepository;
    }

    public function index()
    {
        $carts = $this->cartRepository->all();
        $platforms = $this->platformRepository->all();

        return view('carts.index', compact('carts', 'platforms'));
    }

    public function findById(Request $request)
    {
        $request_data = json_decode($request->data);

        $return_result = $this->cartRepository->findById($request_data->cart_id);

        if (!$return_result) {
            $result['result'] = "error";
            $result['error_message'] = "등록되어 데이터가 없습니다.";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            $platforms = $this->platformRepository->all();

            $result['result'] = "success";
            $result['cart_info'] = $return_result;
            $result['platform_info'] = $platforms;
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }
}
