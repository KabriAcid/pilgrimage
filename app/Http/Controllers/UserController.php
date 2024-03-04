<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function usersList()
    {
        $users = User::all();
        $roles = Role::all();
        return view('user.users', ['users' => $users, 'roles' => $roles]);
    }

    public function storeUser(Request $request)
    {
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'phoneNumber' => request('phoneNumber'),
            'password' => request('password'),
        ]);



        return back()->with('success', 'New user has been added successfully.');
    }

    public function userDetails($id)
    {
        $user = User::where('id', $id)->first();

        $user_roles = UserRole::where('user_id', $user->id)->get();
        // dd( $user_roles);

        $rolesArray = array();

        foreach ($user_roles as $user_role) {
            $actualRole = Role::select('roleName')->where('id', $user_role->role_id)->first();
            if ($actualRole != null) {
                $rolesArray[] = $actualRole->roleName;
            }
        }


        //  dd($rolesArray);

        return view('user.user-details', ['user' => $user, 'actualRoles' => $rolesArray]);
    }
}
