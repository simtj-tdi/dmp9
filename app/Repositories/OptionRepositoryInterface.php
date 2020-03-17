<?php


namespace App\Repositories;


interface OptionRepositoryInterface
{
    public function all();

    public function findById($id);

    public function findByCartId($cart_id);
}
