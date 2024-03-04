<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\UserRole;

use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('user.roles', ['roles' => $roles]);
    }


    public function storeRole(Request $request)
    {
        Role::create([
            'roleName' => request('roleName'),
            'roleDescription' => request('roleDescription'),

        ]);
        return back()->with('success', 'New role has been added successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        return back()->with('success', 'The role has been deleted successfully.');
    }

    public function assignRoletoUser(Request $request)
    {
       
       // dd(request('role_id'));
        UserRole::create ([
            'user_id' => request('user_id'),
            'role_id' => request('role_id')
        ]);
        return back()->with('success', 'The role has been added successfully.');
    }
}
