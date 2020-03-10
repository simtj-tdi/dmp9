<?php

namespace App\Http\Controllers;

use App\Repositories\TaxRepositoryInterface;
use App\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    private $taxRepository;

    public function __construct(TaxRepositoryInterface $taxRepository)
    {
        $this->taxRepository = $taxRepository;
    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Tax $tax)
    {
        //
    }


    public function edit(Tax $tax)
    {
        //
    }

    public function update(Request $request, Tax $tax)
    {
        //
    }


    public function destroy(Tax $tax)
    {
        //
    }
}
