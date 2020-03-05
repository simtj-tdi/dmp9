<?php

namespace App\Http\Controllers;

class DashBoardController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index()
    {
        return view('dashboard');
    }
}
