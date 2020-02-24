<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = faq::orderBy('id', 'desc')->get();

        return view('faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('faqs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        auth()->user()->faqs()->create($validatedData);

        return redirect()->route('faqs.index');
    }

    public function show($id)
    {
        $faq = faq::find($id);
        return view('faqs.show', compact('faq'));
    }

    public function edit($id)
    {
        $faq = faq::find($id);
        return view('faqs.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        faq::find($id)->update($request->all());

        return redirect()->route('faqs.index');
    }

    public function destroy($id)
    {
        faq::find($id)->delete();

        return redirect()->route('faqs.index');
    }
}
