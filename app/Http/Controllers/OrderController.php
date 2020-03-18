<?php

namespace App\Http\Controllers;


use App\Repositories\OrderRepositoryInterface;


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

        return view('orders.history', compact('orders'));
    }
}
