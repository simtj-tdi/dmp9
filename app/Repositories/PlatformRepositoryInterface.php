<?php


namespace App\Repositories;


interface PlatformRepositoryInterface
{
    public function all();

    public function findById($id);
}
