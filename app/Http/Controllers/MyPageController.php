<?php

namespace App\Http\Controllers;

use App\User;
use App\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index()
    {
        return view('mypage.index');
    }

    public function faq_index()
    {
        $faqs = faq::orderBy('id', 'desc')->get();

        return view('mypage.faq.index', compact('faqs'));
    }

    public function faq_create()
    {
        return view('mypage.faq.create');
    }

    public function faq_store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        auth()->user()->faqs()->create($validatedData);

        return redirect()->route('mypage.faq.index');
    }

    public function faq_show($id, Faq $faq)
    {
        $faq = $faq->find($id);

        return view('mypage.faq.show', compact('faq'));
    }

    public function faq_update($id, Request $request)
    {
        faq::find($id)->update($request->all());

        return back();
    }

    public function faq_destroy($id)
    {
        faq::find($id)->delete();

        return redirect()->route('mypage.faq.index');
    }
}
