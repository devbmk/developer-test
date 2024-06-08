<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return Inertia::render('Accounts/Index', [
            'accounts' => $accounts,
        ]);
    }

    public function show(Account $account)
    {
        return Inertia::render('Accounts/Show', [
            'account' => $account,
            'owner' => $account->owner,
            'contacts' => $account->contacts,
        ]);
    }

    public function create()
    {
        $users = User::select('id', 'name')->get();
        return Inertia::render('Accounts/Create', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'owner_id' => 'required|integer',
            'phone' => 'required|string',
            'country' => 'required|string',
            'address' => 'required|string',
            'town_city' => 'required|string',
            'post_code' => 'required|string',
        ]);

        $account = new Account();
        $account->name = $request->input('name');
        $account->owner_id = $request->input('owner_id');
        $account->phone = $request->input('phone');
        $account->country = $request->input('country');
        $account->address = $request->input('address');
        $account->town_city = $request->input('town_city');
        $account->post_code = $request->input('post_code');
        $account->save();

        return redirect()->route('accounts.index');
    }

    public function edit(Account $account)
    {
        $users = User::select('id', 'name')->get();
        return inertia('Accounts/Edit', [
            'account' => $account,
            'users' => $users,
        ]);
    }

    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => 'required|string',                  
        ]);

        $account->update($request->all());
        return redirect()->route('accounts.index');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('accounts.index')->with('success', 'The account was deleted successfully.');
    }
}