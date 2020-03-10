<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    CONST SORT = array('id','updated_at', 'data_name', 'buy_price', 'expiration_date');

    CONST STATE_1 = 1;      // 요청중
    CONST STATE_2 = 2;      // 추출중
    CONST STATE_3 = 3;      // 승인요청
    CONST STATE_4 = 4;      // 결제대기
    CONST STATE_5 = 5;      // 결제완료

    protected $guarded = ['*','id'];

    public function format()
    {
        return [
            'order_id' => $this->id,
            'user_id' => $this->user,
            'payment_id' => $this->payment,
            'order_no' => $this->order_no,
            'data_types' => $this->data_types,
            'data_name' => $this->data_name,
            'data_category' => $this->data_category,
            'data_count' => $this->data_count,
            'buy_price' => $this->buy_price,
            'buy_date' => $this->buy_date,
            'expiration_date' => $this->expiration_date,
            'created_at' => $this->created_at,
            'payment' => $this->payment,
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

    public function getMarkPriceAttribute()
    {
        return number_format($this->buy_price);
    }

}
