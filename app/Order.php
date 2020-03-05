<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    CONST STATE_1 = 1;      // 주문 신청
    CONST STATE_2 = 2;      // 결제 요청
    CONST STATE_3 = 3;      // 결제 완료
    CONST STATE_4 = 4;      // 유효 기간 완료

    protected $guarded = ['*','id'];

    public function format()
    {
        return [
            'order_id' => $this->id,
            'user_id' => $this->user,
            'payment_id' => $this->payment,
            'order_no' => $this->order_no,
            'types' => $this->types,
            'data_name' => $this->data_name,
            'data_category' => $this->data_category,
            'data_count' => $this->data_count,
            'buy_price' => $this->buy_price,
            'buy_date' => $this->buy_date,
            'expiration_date' => $this->expiration_date,
            'created_at' => $this->created_at,
            'last_update' => $this->updated_at->diffForHumans()
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment_return::class);
    }


}
