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


    public function update($request)
    {
        $id = auth()->user()->id;
        user::find($id)->update($request->all());
    }

    public function password_check($request)
    {
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return false;
        }

        return true;
    }
}
