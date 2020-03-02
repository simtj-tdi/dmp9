<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay_log extends Model
{
    protected $fillable = [
        'user_id','state','message'
    ];
}
