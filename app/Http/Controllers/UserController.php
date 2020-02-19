<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index(Request $request)
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function confirm_index()
    {
        $user = auth()->user();
        return view('users.confirm_index', compact('user'));
    }

    public function confirm_check(Request $request)
    {
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back();
        }

        return redirect()->route('my_show', ['id'=> auth()->user()->id]);

    }

    public function my_show($id)
    {
        $user = auth()->user();
        return view('users.my_show', compact('user'));
    }

    public function my_update(Request $request)
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

        return redirect()->route('dashboard.index');
    }
}
