<?php


namespace App\Repositories;

use App\Goods;

class GoodsRepository implements GoodsRepositoryInterface
{
    public function all()
    {
        $goods = goods::orderBy('id','desc')
            ->paginate(5);

        $goods->getCollection()->map->format();

        return $goods;
    }

    public function findById($id)
    {
        return goods::where('id', $id)
            ->firstOrFail()
            ->format();
    }

    public function findByIds($ids)
    {
        return $goods = goods::whereIn('id', $ids)
            ->get();
    }

    public function create($request)
    {
        $goods = auth()->user()->goods()->create($request->toArray());

        return $goods;
    }

    public function update($request, $id)
    {
        $goods = goods::where('id', $id)->firstOrFail();
        $goods->update($request->all());
    }

    public function destory($id)
    {
        goods::where('id', $id)->delete();
    }

    public function expirationdate_update($expirationdate, $id)
    {
        goods::where('id', $id)->update(['expiration_date' => $expirationdate]);
    }
}
