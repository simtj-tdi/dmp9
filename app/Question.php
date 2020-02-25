<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title', 'content',
    ];

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
