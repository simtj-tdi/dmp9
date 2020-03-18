<?php


namespace App\Repositories;

use App\Option;

class OptionRepository implements OptionRepositoryInterface
{
    public function all()
    {
        $option = option::order('id', 'desc')
            ->get()
            ->format();
    }

    public function findById($id)
    {
        return option::where('id', $id)
            ->first();
    }

    public function findByCartIdCount($cart_id)
    {
        return option::where('cart_id', $cart_id)
            ->count();
    }

    public function crateOption($request)
    {
        $option['user_id'] = auth()->user()->id;
        $option['cart_id'] = $request->cart_id;
        $option['platform_id'] = $request->platform_id;
        $option['sns_id'] = $request->sns_id;
        $option['sns_password'] = $request->sns_password;

        return option::create($option);
    }

    public function updateOption($request, $id)
    {
        $option['sns_id'] = $request->sns_id;
        $option['sns_password'] = $request->sns_password;

        return option::where('id', $id)->update($option);
    }

    public function stataUpdate($id)
    {
        return option::where('id', $id)->update(['state' => Option::STATE_2]);
    }


}
