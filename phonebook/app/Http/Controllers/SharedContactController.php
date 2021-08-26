<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SharedContactController extends Controller
{

    public function share(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        // check if it's not already shared

        $user = DB::table('users')->select('id', 'name')->where('email', '=', $request->email)->first();
        if (DB::table('shared_contacts')
            ->where('contact_id', '=', $request->id)
            ->where('viewer_id', '=', $user->id)->exists()) {

            return redirect()->route('dashboard')->withErrors(['Error' => 'Contact is already shared with ' . $user->name]);
        }

        DB::table('shared_contacts')->insert([
            'contact_id' => $request->id,
            'viewer_id' => $user->id,
        ]);

        return redirect()->route('dashboard')->with('message', 'Contact was shared with ' . $user->name);
    }

    public function sharedByMe()
    {

        $sharedByMe = DB::table('users')
            ->join('shared_contacts', 'users.id', 'shared_contacts.viewer_id')
            ->join('contacts', 'contacts.id', 'shared_contacts.contact_id')
            ->where('owner_id', Auth::id())
            ->get();


        return view('sharedbyme', ['contacts' => $sharedByMe]);


    }

    public function sharedToMe()
    {
        $sharedToMe = DB::table('shared_contacts')
            ->join('contacts', 'contacts.id', 'shared_contacts.contact_id')
            ->join('users', 'users.id', 'contacts.owner_id')
            ->get();

        return view('sharedToMe', ['contacts' => $sharedToMe]);
    }

    public function stopshare($id)
    {
        DB::table('shared_contacts')->where('shared_contact_id', '=', $id)->delete();
        return redirect()->route('sharedByMe')->withErrors(['Error' => 'You stopped sharing contact']);
    }
}
