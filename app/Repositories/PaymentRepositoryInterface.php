<?php

namespace App\Repositories;

interface PaymentRepositoryInterface
{

    public function payReturn($request);

    public function payLog($state, $message);

    public function findByOrder($order_no);

    public function payReturnByCallback($request);
}
