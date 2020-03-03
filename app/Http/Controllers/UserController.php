<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Collection;


class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function confirm_index()
    {
        return view('users.confirm_index');
    }

    public function confirm_check(Request $request)
    {
        if (!$this->userRepository->password_check($request)) {
            return back();
        }

        return redirect()->route('my_show');
    }

    public function my_show()
    {
        $user = $this->userRepository->findById();
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
