<?php

namespace App\Http\Controllers;

use App\Repositories\CartRepositoryInterface;
use App\Repositories\PlatformRepositoryInterface;

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
}
