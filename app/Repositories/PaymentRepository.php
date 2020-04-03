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
        
        $pay_log['state'] = $state;
        $pay_log['message'] = $message;

        pay_log::create($pay_log);
    }

    public function payReturnByCallback($request)
    {
        $request_date['cash_receipt'] = json_encode($request->cash_receipt);
        $request_date['tid'] = $request->tid;
        $request_date['cid'] = $request->cid;
        $request_date['pay_info'] = $request->pay_info;
        $request_date['custom_parameter'] = $request->custom_parameter;
        $request_date['domestic_flag'] = $request->domestic_flag;
        $request_date['install_month'] = $request->install_month;
        $request_date['tax_amount'] = $request->tax_amount;
        $request_date['taxfree_amount'] = $request->taxfree_amount;
        $request_date['nonsettle_amount'] = $request->nonsettle_amount;
        $request_date['payhash'] = $request->payhash;
        $request_date['transaction_date'] = $request->transaction_date;

        return $payment_info = payment_return::where('order_no',$request->order_no)->update($request_date);
    }

}
