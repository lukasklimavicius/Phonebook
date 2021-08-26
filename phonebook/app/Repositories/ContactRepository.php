<?php

namespace App\Repositories;


use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactRepository
{

    public function store(Request $request)
    {
        Contact::create([
            'owner_id' => Auth::id(),
            'contact_name' => $request->contact_name,
            'contact_phone_number' => $request->contact_phone_number,
        ]);

    }

    public function update(Request $request)
    {
        $contact = Contact::find($request->id);
        $contact->update($request->toArray());
    }

    public function delete(Contact $contact)
    {

        $contact->delete();
    }
}
