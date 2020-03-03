<?php

namespace App\Repositories;

use App\Faq;

class FaqRepository implements FaqRepositoryInterface
{
    public function all()
    {
        $faqs = faq::orderBy('id','desc')
            ->paginate(5);

        $faqs->getCollection()
                    ->transform(function ($faq) {
                    return [
                        'faq_id' => $faq->id,
                        'name' => $faq->user->name,
                        'title' => $faq->title,
                        'content' => $faq->content,
                        'email' => $faq->user->email,
                        'last_update' => $faq->updated_at->diffForHumans(),
                    ];
                });

        return $faqs;
    }

    public function findById($id)
    {
        return faq::where('id', $id)
            ->firstOrFail()
            ->format();
    }

    public function create($request)
    {
        auth()->user()->faqs()->create($request);
    }

    public function update($request, $id)
    {
        $faq = faq::where('id', $id)->firstOrFail();
        $faq->update($request->only('title', 'content'));
    }

    public function destory($id)
    {
        faq::where('id', $id)->delete();
    }
}
