<?php
namespace App\Repositories;

interface UserRepositoryInterface
{
    public function findById();

    public function makePassword($password);

    public function update($request);

    public function password_check($request);
}
