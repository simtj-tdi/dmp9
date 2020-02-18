<?php

namespace App\Http\Controllers;

use App\User;
use App\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyPageController extends Controller
{
    //
    function __construct()
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

    public function my_confirm()
    {
        return view('mypage.info.confirm');
    }

    public function my_confirm_check(Request $request)
    {
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back();
        }

        return redirect()->route('mypage.info.show');
    }

    public function my_info_show()
    {
        $user = auth()->user();
        return view('mypage.info.show', compact('user'));
    }

    public function my_info_update(Request $request)
    {
        $request = array_filter($request->toArray(), function ($v, $k) {
            return !empty($v) && $k != '_token';
        }, ARRAY_FILTER_USE_BOTH);

        array_walk_recursive($request,function (&$val, &$key) {
            if ($key == "password") {
                $val = Hash::make($val);
            }
        });

        User::find(auth()->user()->id)->update($request);
    }


}
