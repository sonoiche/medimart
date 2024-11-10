<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['account'] = User::find($id);
        return view('account', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountRequest $request, string $id)
    {
        $account = User::find($id);
        $account->name     = $request['name'];
        $account->email    = $request['email'];
        $account->role     = $request['role'];
        $account->address  = $request['address'];
        $account->city     = $request['city'];
        $account->province = $request['province'];
        $account->postal_zip = $request['postal_zip'];

        if(isset($request['password'])) {
            $account->password = bcrypt($request['password']);
        }

        $account->save();

        return redirect()->back()->with('success', 'Information has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
