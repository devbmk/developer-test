<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Account;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('account')->get();
        return Inertia::render('Contacts/Index', [
            'contacts' => $contacts,
        ]);
    }

    public function show(Contact $contact)
    {
        $contact->load('account');
        return Inertia::render('Contacts/Show', [
            'contact' => $contact,
            'account' => $contact->account,
        ]);
    }

    public function create()
    {
        $accounts = Account::select('id', 'name')->get();
        return Inertia::render('Contacts/Create', [
            'accounts' => $accounts
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'position' => 'required|string',
            'account_id' => 'required|integer',
        ]);
        $contact = new Contact();
        $contact->first_name = $request->input('first_name');
        $contact->last_name = $request->input('last_name');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->position = $request->input('position');
        $contact->account_id = $request->input('account_id');
        $contact->save();
        return redirect()->route('contacts.index');
    }

    public function edit(Contact $contact)
    {
        $accounts = Account::select('id', 'name')->get();
        return Inertia::render('Contacts/Edit', [
            'contact' => $contact,
            'accounts' => $accounts,
        ]);
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'email' => 'required|string',            
        ]);
        $contact->update($request->all());
        return redirect()->route('contacts.index');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'The contact was deleted successfully.');
    }
}
