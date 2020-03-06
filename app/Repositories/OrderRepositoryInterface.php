<?php


namespace App\Repositories;


interface OrderRepositoryInterface
{
    public function all($request);

    public function findById($id);

    public function create($request);

    public function update($request, $id);

    public function destory($id);

    public function order_no_update($id, $order_no);

    public function state_update($order_no, $payment_id, $payment_transaction_date);
}
