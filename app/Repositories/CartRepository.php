<?php


namespace App\Repositories;

use App\Cart;
use App\Goods;

class CartRepository implements CartRepositoryInterface
{
    public function all()
    {
        $carts = auth()->user()->carts()
            ->get();

        $carts->map->format();

        return $carts;
    }

    public function findById($id)
    {
        return cart::where('id', $id)
            ->firstOrFail()
            ->format();
    }

    public function create(Goods $goods)
    {
        $cart['goods_id'] = $goods->id;

        auth()->user()->carts()->create($cart);
    }

    public function update($request, $id)
    {
        $cart = cart::where('id', $id)->firstOrFail();
        $cart->update($request->all());
    }

    public function destory($id)
    {
        cart::where('id', $id)->delete();
    }

    public function updateOrder_no($ids, $order_no)
    {
        cart::whereIn('id', $ids)->update(['order_no'=>$order_no]);
    }

    public function buydate_update($order_no, $buydate)
    {
        cart::where('order_no', $order_no)->update(['state' => Cart::STATE_2, 'buy_date' => $buydate]);
    }
}
