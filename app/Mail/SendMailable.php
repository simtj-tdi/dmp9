<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $user_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->name = $user->name;
        $this->user_id = $user->user_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = "http://".$_SERVER['HTTP_HOST']."/sign_up_find_new_pw";

        return $this->subject('DMP9에서 드리는 알림메일입니다.')->markdown('emails.password', ['name'=>$this->name, 'user_id'=>$this->user_id, 'url'=>$url]);
    }
}
