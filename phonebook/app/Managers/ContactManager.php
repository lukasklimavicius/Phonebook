<?php

namespace App\Managers;

use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactManager {
    public function __construct(private ContactRepository $contactRepository)
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'contact_name' => 'required|string|max:70',
            'contact_phone_number' => 'required|string|max:30',
        ]);

        return $this->contactRepository->store($request);
    }

    public function update(Request $request)
    {
        $request->validate([
            'contact_name' => 'required|string|max:70',
            'contact_phone_number' => 'required|string|max:30',
        ]);

        $this->contactRepository->update($request);
    }

    public function delete(Contact $contact)
    {
        $this->contactRepository->delete($contact);
    }
}
