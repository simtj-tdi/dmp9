<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        $orders = auth()->user()->orders;

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $types = implode(',', $request->types);
        $param = [
            'user_id' => auth()->user()->id,
            'state' => '1',
            'types' => $types,
            'data_name' => $request->data_name,
            'data_count' => $request->data_count,
            'buy_price' => $request->buy_price,
            'buy_date' => $request->buy_date,
            'expiration_date' => $request->expiration_date
        ];

        Order::create($param);

        return redirect()->route('orders.index');
    }

    public function show($id)
    {
        $order = order::find($id);

        return view('orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = order::find($id);
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $types = implode(',', $request->types);
        $param = [
            'state' => '1',
            'types' => $types,
            'data_name' => $request->data_name,
            'data_count' => $request->data_count,
            'buy_price' => $request->buy_price,
            'buy_date' => $request->buy_date,
            'expiration_date' => $request->expiration_date
        ];

        Order::where('id', $id)->update($param);

        return redirect()->route('orders.index');
    }

    public function destroy($id)
    {
        order::find($id)->delete();

        return redirect()->route('orders.index');    }
}
