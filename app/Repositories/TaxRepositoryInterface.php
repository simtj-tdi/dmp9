<?php


namespace App\Repositories;


interface TaxRepositoryInterface
{
    public function all();

    public function findById($id);

    public function create($request);

    public function update($request);

    public function destory($id);
}
