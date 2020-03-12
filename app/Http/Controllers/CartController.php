<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Repositories\CartRepositoryInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function index()
    {
        $carts = $this->cartRepository->all();

        return view('carts.index', compact('carts'));
    }
}
