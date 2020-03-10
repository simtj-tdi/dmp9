<?php


namespace App\Repositories;

use App\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function all($request)
    {

        $orders = auth()->user()->orders()
            ->when(in_array($request->sort,order::SORT) == true,
                function ($q) use ($request) {
                    return $q->orderBy($request->sort, 'desc');
                },
                function ($q) use ($request) {
                    return $q->orderBy('id','desc');
                }
            )
            ->when(isset($request->sch) == true,
                function ($q) use ($request) {
                    return $q->where('data_name','LIKE','%'.$request->sch.'%');
                }
            )
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
        $request['data_types'] = implode(',', $request->data_types);
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
            ->update(['payment_id'=> $payment_id, 'state' => order::STATE_4, 'buy_date'=> $payment_transaction_date ]);
    }

}
