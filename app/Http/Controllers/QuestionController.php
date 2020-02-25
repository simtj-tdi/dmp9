<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = question::orderBy('id', 'desc')->get();

        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        auth()->user()->questions()->create($validatedData);

        return redirect()->route('questions.index');
    }

    public function show($id)
    {
        $questions = question::find($id);
        return view('questions.show', compact('questions'));
    }

    public function edit($id)
    {
        $questions = question::find($id);
        return view('questions.edit', compact('questions'));
    }

    public function update(Request $request, $id)
    {
        question::find($id)->update($request->all());

        return redirect()->route('questions.index');
    }

    public function destroy($id)
    {
        question::find($id)->delete();

        return redirect()->route('questions.index');
    }
}
