<?php


namespace App\Repositories;

use App\Contactsus;

class ContactsusRepository implements contactsusrepositoryinterface
{
    public function all()
    {
        $faqs = Contactsus::orderBy('id','desc')
            ->get();

        $faqs->map->format();

        return $faqs;
    }

    public function findById($id)
    {
        return Contactsus::where('id', $id)
            ->firstOrFail()
            ->format();
    }

    public function create($request)
    {
        $contactsus['name'] = $request->name;
        $contactsus['phone'] = $request->phone;
        $contactsus['email'] = $request->email;
        $contactsus['content'] = $request->content;

        return Contactsus::create($contactsus);
    }

}
