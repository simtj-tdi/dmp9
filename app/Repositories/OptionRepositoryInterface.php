<?php


namespace App\Repositories;


interface OptionRepositoryInterface
{
    public function all();

    public function findById($id);

    public function findByCartIdCount($cart_id);

    public function crateOption($request);

    public function updateOption($request, $id);

    public function stataUpdate($id);
}
