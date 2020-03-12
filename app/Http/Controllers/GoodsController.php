<?php

namespace App\Http\Controllers;

use App\Goods;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\GoodsRepositoryInterface;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    private $goodsRepository;
    private $cartRepository;

    public function __construct(GoodsRepositoryInterface $goodsRepository, CartRepositoryInterface $cartRepository)
    {
        $this->goodsRepository = $goodsRepository;
        $this->cartRepository= $cartRepository;
    }

    public function store(Request $request)
    {
        $goods = $this->goodsRepository->create($request);

        $this->cartRepository->create($goods);

        return redirect()->route('carts.index');
    }

}
