<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];

    public function format()
    {
        return [
            'option_id' => $this->id,
            'cart_id' => $this->cart_id,
            'platform_id' => $this->platform_id,
            'sns_id' => $this->sns_id,
            'sns_password' => $this->sns_password,
            'state' => $this->state
        ];
    }
}
