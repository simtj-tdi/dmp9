<?php
namespace App\Repositories;

interface UserRepositoryInterface
{
    public function findById();

    public function makePassword($password);

    public function create($request);

    public function update($request);

    public function password_check($request);

    public function findByUserId($user_id);

    public function SingUpFindId($request);

    public function SingUpFindById($request);

    public function SingUpNewPw($request);

    public function findByPhone($phone);
}
