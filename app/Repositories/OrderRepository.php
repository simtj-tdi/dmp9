<?php


namespace App\Repositories;

use App\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function all()
    {
        $orders = auth()->user()->orders()
            ->where('state', 1)
            ->orderBy('id', 'desc')
            ->get()
            ->map->format();

        return $orders;
    }

    public function findById($id)
    {
        return order::where('id', $id)
            ->get()
            ->map->format();
    }

    public function create($order_no, $pay_data)
    {
        $order['order_no'] = $order_no;
        $order['order_name'] = $pay_data['product_name'];
        $order['goods_info'] = $pay_data['goods_info'];
        $order['state'] = order::ORDER_STATE_0;
        $order['tax_state'] = order::TAX_STATE_1;
        $order['total_count'] = $pay_data['count'];
        $order['total_price'] = $pay_data['amount'];
        auth()->user()->orders()->create($order);
    }


    public function update($request, $id)
    {
        $order = order::where('id', $id)->firstOrFail();
        $order->update($request->all());
    }

    public function state_update_state($order_no, $payment_id)
    {
        order::where('order_no', $order_no)
            ->update(['payment_id' => $payment_id, 'state' => order::ORDER_STATE_1]);
    }

    public function taxstate_update($request)
    {
        return order::whereIn('id', $request->ids)->update(['tax_state'=> Order::TAX_STATE_2]);

    }

    public function findByOrder($order_no)
    {
        return order::where('order_no', $order_no)
            ->get()
            ->map->format();
    }
}
