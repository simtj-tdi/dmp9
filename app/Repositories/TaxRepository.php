<?php


namespace App\Repositories;


use App\Tax;

class TaxRepository implements TaxRepositoryInterface
{
    public function all()
    {

    }

    public function findById($id)
    {

    }

    public function create($request)
    {
        tax::create($request);
    }

    public function update($request, $id)
    {

    }

    public function destory($id)
    {

    }

}
