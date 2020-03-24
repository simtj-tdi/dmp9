<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password','approved','approved_at'
//    ];

    protected $guarded = ['*','id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function goods()
    {
        return $this->hasMany(Goods::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class)->orderBy('id','desc');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function payment_returns()
    {
        return $this->hasMany(Payment_return::class);
    }

    public function taxs()
    {
        return $this->hasMany(Tax::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
