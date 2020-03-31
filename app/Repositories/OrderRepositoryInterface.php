<?php


namespace App\Repositories;


interface OrderRepositoryInterface
{
    public function all();

    public function findById($id);

    public function create($order_no, $pay_data);

    public function update($request, $id);

    public function state_update_state($order_no, $payment_id);

    public function taxstate_update($request);
}
