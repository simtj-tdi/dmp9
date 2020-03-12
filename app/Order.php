<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    CONST STATE_1 = 0;      // 결제전
    CONST STATE_2 = 1;      // 결제완료

    protected $guarded = ['*','id'];

    public function format()
    {
        return [
            'order_id' => $this->id,
            'user_id' => $this->user_id,
            'payment_id' => $this->payment_id,
            'order_no' => $this->order_no,
            'goods_info' => $this->goods_info,
            'state' => $this->state,
            'total_price' => $this->total_price,
            'updated_at' => $this->updated_at
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
