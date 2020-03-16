<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Repositories\TaxRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::INDEX;

    private $userRepository;
    private $taxRepository;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function __construct(UserRepositoryInterface $userRepository, TaxRepositoryInterface $taxRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
        $this->taxRepository = $taxRepository;
    }

    public function showRegistrationForm(Request $request)
    {

        if ($request->type == "company") {
            return view('sign.sign_up_company');
        } else if ($request->type == "personal") {
            return view('sign.sign_up_personal');
        }

        return view('auth.register');
    }


    public function register(RegisterRequest $request)
    {

        $request['email'] = $request['email_id'].'@'.$request['email_text'];
        $request['phone'] = $request['phone_1'].'-'.$request['phone_2'].'-'.$request['phone_3'];

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function create(array $data)
    {

        $users = $this->userRepository->create($data);

        if ($data['type'] == "company") {
            $path = explode('/', $data['tax_img']->store('tax/'.$data['user_id']));

            $data['user_id'] = $users['id'];
            $data['tax_img'] = $path[2];
            $this->taxRepository->create($data);
        }

        return $users;
    }
}
