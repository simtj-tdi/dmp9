<?php

namespace App\Http\Controllers;

use App\Mail\SendMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function id_check(Request $request)
    {
        dd($request);
    }

    public function mail()
    {
        $name = 'Krunal';
        Mail::to('taejin7937@gmail.com')->send(new SendMailable($name));


        return 'Email was sent';
    }

    public function mailarray()
    {
        $to_name = 'TO_NAME';
        $to_email = 'taejin7937@gmail.com';
        $data = array('name'=>"Sam Jose", "body" => "Test mail");

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Artisans Web Testing Mail');
            $message->from('simtj@nsmg21.com','Artisans Web');
        });
    }
}
