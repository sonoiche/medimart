<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Api\UserRequest as ApiUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name     = $request['name'];
        $user->email    = $request['email'];
        $user->role     = $request['role'];
        $user->address  = $request['address'];
        $user->city     = $request['city'];
        $user->province = $request['province'];
        $user->postal_zip = $request['postal_zip'];

        if(isset($request['password'])) {
            $user->password = bcrypt($request['password']);
        }

        $user->save();

        return redirect()->to('admin/admin-users')->with('success', 'User has been created.');
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
        $data['user'] = User::find($id);
        return view('admin.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApiUserRequest $request, string $id)
    {
        $user = User::find($id);
        $user->name     = $request['name'];
        $user->email    = $request['email'];
        $user->role     = $request['role'];
        $user->address  = $request['address'];
        $user->city     = $request['city'];
        $user->province = $request['province'];
        $user->postal_zip = $request['postal_zip'];

        if(isset($request['password'])) {
            $user->password = bcrypt($request['password']);
        }

        $user->save();

        return redirect()->to('admin/admin-users')->with('success', 'User has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(200);
    }

    public function updateUser(UserRequest $request, $id){
        $user = User::find($id);
        $user->name     = $request['name'];
        $user->email    = $request['email'];
        $user->role     = $request['role'];
        $user->address  = $request['address'];
        $user->city     = $request['city'];
        $user->province = $request['province'];
        $user->postal_zip = $request['postal_zip'];

        if(isset($request['password'])) {
            $user->password = bcrypt($request['password']);
        }

        $user->save();

        return redirect()->to('admin/admin-users')->with('success', 'User has been created.');
    }
}
