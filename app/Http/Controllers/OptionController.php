<?php

namespace App\Http\Controllers;

use App\Option;
use App\Repositories\OptionRepositoryInterface;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    private $optionRepository;

    public function __construct(OptionRepositoryInterface $optionRepository)
    {
        $this->optionRepository = $optionRepository;
    }

    public function index()
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Option $option)
    {
    }

    public function edit(Option $option)
    {
    }

    public function update(Request $request, Option $option)
    {
    }

    public function destroy(Option $option)
    {
    }
}
