<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }
    public function warnIntrusion(){
        return view ('auth.warn');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
           // dd($user);

            $user_roles = UserRole::where('user_id', $user->id)->get();
           
           //dd ($user_roles);
            session(['canViewAddPropertyForm' => false]);
            session(['canAllocateBedSpace'  =>false]);
            session(['canViewAllReports'  => false]);
            session(['canUploadAlhazai' => false]);
            session(['canAllocateSpace' =>false]);
            session(['isSuperAdmin' =>false]);


            foreach ($user_roles as $user_role) {
              //  dd($user_role->role_id);
                $actualRole = Role::where('id', $user_role->role_id)
                ->first();
//dd ($actualRole);
                if ($actualRole->roleName == 'Accomodation Officer') {
                    //dd($actualRole->roleName);
                    
                 session(['canViewAddPropertyForm' => true]);
                    
                } elseif ($actualRole->roleName == 'Board Chairman'){
                    session(['canViewAllReports' => true]);

                }
                elseif ($actualRole->roleName == 'Alhazai Officer'){
                    session(['canUploadAlhazai' => true]);

                }
                elseif ($actualRole->roleName == 'Allocation Officer'){
                    session(['canAllocateSpace' =>true]);

                }
                elseif ($actualRole->roleName == 'Director Operations'){
                    session([ 'canViewAllReports' => true]);
                    session([ 'isSuperAdmin' => true]);
                }
                elseif ($actualRole->roleName == 'Super Admin'){
                    session([ 'canViewAllReports' => true]);
                    session([ 'isSuperAdmin' => true]);
                }
                
                
            }


            return redirect()->intended('/home');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
