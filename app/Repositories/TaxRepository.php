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

    public function update($request)
    {
        $id = auth()->user()->id;

        tax::where('user_id', $id)->update([
            'tax_name' => $request['tax_name'],
            'tax_company_name' => $request['tax_company_name'],
            'tax_industry' => $request['tax_industry'],
            'tax_zipcode' => $request['tax_zipcode'],
            'tax_addres_1' => $request['tax_addres_1'],
            'tax_addres_2' => $request['tax_addres_2'],
            'tax_reference' => $request['tax_reference'],
        ]);
    }

    public function destory($id)
    {

    }

}
