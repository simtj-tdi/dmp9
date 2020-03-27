<?php


namespace App\Repositories;


interface ContactsusRepositoryInterface
{
    public function all();

    public function findById($id);

    public function create($request);
}
