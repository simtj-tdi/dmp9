<?php


namespace App\Repositories;

use App\Goods;

interface CartRepositoryInterface
{
    public function all();

    public function findById($id);

    public function create(Goods $goods);

    public function update($request, $id);

    public function destory($id);

    public function updateOrder_no($ids, $order_no);

    public function buydate_update($order_no, $buydate);
}
