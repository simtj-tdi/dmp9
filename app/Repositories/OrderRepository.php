<?php


namespace App\Repositories;

use App\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function all()
    {
        $orders = auth()->user()->orders()
            ->orderBy('id','desc')
            ->paginate(5);

        $orders->getCollection()->map->format();

        return $orders;
    }

    public function findById($id)
    {
        return order::where('id', $id)
            ->firstOrFail()
            ->format();
    }

    public function create($request)
    {
        $request['types'] = implode(',', $request->types);
        $request['state'] = order::STATE_1;

        auth()->user()->orders()->create($request->toArray());
    }

    public function update($request, $id)
    {
        $order = order::where('id', $id)->firstOrFail();
        $order->update($request->all());
    }

    public function destory($id)
    {
        order::where('id', $id)->delete();
    }

    public function order_no_update($id, $order_no)
    {
        order::where('id', $id)
            ->update(['order_no' => $order_no]);
    }

    public function state_update($order_no, $payment_id, $payment_transaction_date)
    {
        order::where('order_no', $order_no)
            ->update(['payment_id'=> $payment_id, 'state' => order::STATE_3, 'buy_date'=> $payment_transaction_date ]);
    }

}
