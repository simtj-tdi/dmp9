<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyDateController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index()
    {
        return view('mydate.index');
    }
}
