<?php

namespace App\Repositories;

use App\Question;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function all()
    {
        $questions = auth()->user()->questions()
        ->orderBy('id', 'desc')
        ->paginate(5);

        $questions->getCollection()->map->format();;

        return $questions;
    }

    public function findById($id)
    {
        return question::where('id', $id)
            ->firstOrFail()
            ->format();
    }

    public function create($request)
    {
        auth()->user()->questions()->create($request);
    }

    public function update($request, $id)
    {
        $question = question::where('id', $id)->firstOrFail();
        $question->update($request->only('title', 'content'));
    }

    public function destory($id)
    {
        question::where('id', $id)->delete();
    }
}
