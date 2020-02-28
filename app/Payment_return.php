<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_return extends Model
{
    //
    protected $fillable = [
        'code', 'message','user_id','user_name','order_no','service_name','product_name','custom_parameter','pgcode','tid','cid','amount','pay_info','domestic_flag','install_month','payhash','taxfree_amount','tax_amount','nonsettle_amount','transaction_date',
    ];
}
