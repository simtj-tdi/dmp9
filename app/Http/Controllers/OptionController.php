<?php

namespace App\Http\Controllers;

use App\Option;
use App\Repositories\GoodsRepositoryInterface;
use App\Repositories\OptionRepositoryInterface;
use App\Repositories\PlatformRepositoryInterface;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    private $goodsRepository;
    private $optionRepository;
    private $platformRepository;

    public function __construct(GoodsRepositoryInterface $goodsRepository,
                                OptionRepositoryInterface $optionRepository,
                                PlatformRepositoryInterface $platformRepository
)
    {
        $this->goodsRepository = $goodsRepository;
        $this->optionRepository = $optionRepository;
        $this->platformRepository = $platformRepository;
    }

    public function index()
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Option $option)
    {
    }

    public function edit(Option $option)
    {
    }

    public function update(Request $request, Option $option)
    {
    }

    public function destroy(Option $option)
    {
    }

    public function optionAdd(Request $request)
    {
        $request_data = json_decode($request->data);

        $goods_info = $this->goodsRepository->findById($request_data->goods_id);
        $option_cnt = $this->optionRepository->findByCartIdCount($request_data->cart_id);

        if ($goods_info['data_request'] < $option_cnt || $goods_info['data_request'] == 0) {
            $result['result'] = "error";
            $result['error_message'] = "요청 횟수를 확인 해주세요.";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

            return $response;
        }

        $platform_info = $this->platformRepository->findById($request_data->platform_id);
        $result['result'] = "success";
        $result['platform_info'] = $platform_info;
        $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

        return $response;
    }

    public function optionSave(Request $request)
    {
        $request_data = json_decode($request->data);
        $option_info = $this->optionRepository->findById($request_data->option_id);

        if (!$option_info) {
            $return_result = $this->optionRepository->crateOption($request_data);
        } else {
            $return_result = $this->optionRepository->updateOption($request_data, $option_info->id);
        }

        if (!$return_result) {
            $result['result'] = "error";
            $result['error_message'] = "등록되어 있는 대상 플랫폼이 없습니다.";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

            return $response;
        } else {
            $result['result'] = "success";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }

    public function optionUploadRequest(Request $request)
    {
        $request_data = json_decode($request->data);
        $option_info = $this->optionRepository->findById($request_data->option_id);

        if (!$option_info) {
            $result['result'] = "error";
            $result['error_message'] = "등록되어 있는 대상 플랫폼이 없습니다.";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

            return $response;
        } else {
            $return_result = $this->optionRepository->stataUpdate($request_data->option_id);
        }

        if (!$return_result) {
            $result['result'] = "error";
            $result['error_message'] = "등록되어 있는 대상 플랫폼이 없습니다.";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

            return $response;
        } else {
            $result['result'] = "success";
            $response = response()->json($result, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }
}
