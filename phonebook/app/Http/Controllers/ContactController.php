<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Managers\ContactManager;

class ContactController extends Controller
{
    public function __construct(private ContactManager $contactManager)
    {

    }
    public function index()
    {
        $contacts = Contact::all()->
            where('owner_id', Auth::id());

        $users = User::all()->
        where('id', '!=', Auth::id());


        return view('dashboard', ['contacts' => $contacts], ['users' => $users]);
    }

    public function store(Request $request)
    {
        $this->contactManager->store($request);
        return redirect()->route('dashboard')->with('message', 'Contact was created!');
    }

    public function update(Request $request)
    {

        $this->contactManager->update($request);
        return redirect(route('dashboard'))->with('message', 'Contact was updated!');
    }

    public function delete(Contact $contact)
    {
        $this->contactManager->delete($contact);
        return redirect(route('dashboard'))->with('message', 'Contact was deleted!');
    }
}
