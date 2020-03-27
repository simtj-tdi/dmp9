<?php
namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function findById()
    {
        return $user = auth()->user();
    }

    public function makePassword($password = null)
    {
        if (is_null($password)) {
            $password = auth()->user()->password;
        } else {
            $password = Hash::make($password);
        }

        return $password;
    }

    public function create($request)
    {
        return user::create([
            'role' => $request['type'],
            'user_id' => $request['user_id'],
            'name' => $request['name'],
            'password' => Hash::make($request['password']),
            'email' => $request['email'],
            'phone' => $request['phone'],
            'company_name' => $request['company_name'],
        ]);
    }

    public function update($request)
    {
        $id = auth()->user()->id;
        user::find($id)->update([
            'role' => $request['type'],
            'name' => $request['name'],
            'password' => $request['password'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'company_name' => $request['company_name'],
        ]);
    }

    public function password_check($request)
    {
        if (!Hash::check($request->password, auth()->user()->password)) {
            return false;
        }

        return true;
    }

    public function findByUserId($user_id)
    {
        $user_id = user::where('user_id', $user_id)
            ->get();

        return $user_id;
    }

    public function SingUpFindId($request)
    {
        $user_id = user::where('name', $request->name)
            ->where('phone', $request->phone)
            ->get();

        return $user_id;
    }

}
