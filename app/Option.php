<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];

    CONST STATE_1 = 1;      // 업로드 요청대기
    CONST STATE_2 = 2;      // 업로드 요청
    CONST STATE_3 = 3;      // 업로드 완료

    public function format()
    {
        return [
            'option_id' => $this->id,
            'cart_id' => $this->cart_id,
            'platform_id' => $this->platform,
            'sns_id' => $this->sns_id,
            'sns_password' => $this->sns_password,
            'state' => $this->state
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

}
