<?php


namespace App\Repositories;

use App\Payment_return;
use App\Pay_log;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function payReturn($request)
    {
        auth()->user()->payment_returns()->create($request->toArray());
    }

    public function findByOrder($order_no)
    {
        return payment_return::where('order_no',$order_no)
            ->firstOrFail();
    }

    public function payLog($state, $message)
    {
        $pay_log['user_id'] = auth()->user()->id;
        $pay_log['state'] = $state;
        $pay_log['message'] = $message;

        pay_log::create($pay_log);
    }

}
