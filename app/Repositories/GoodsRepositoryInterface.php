<?php


namespace App\Repositories;


interface GoodsRepositoryInterface
{
    public function all();

    public function findById($id);

    public function findByIds($ids);

    public function create($request);

    public function update($request, $id);

    public function destory($id);

    public function expirationdate_update($expirationdate, $id);
}
