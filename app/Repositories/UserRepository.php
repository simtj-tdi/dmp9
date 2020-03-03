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


    public function update($request)
    {

    }

    public function password_check($request)
    {
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return false;
        }

        return true;
    }
}
