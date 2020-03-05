<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

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
        $request['password'] = $this->userRepository->makePassword($request['password']);

        $this->userRepository->update($request);

        return redirect()->route('dashboard.index');
    }
}
