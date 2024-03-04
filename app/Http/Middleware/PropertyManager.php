<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;

use App\Models\UserRole;

class PropertyManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)

    {
        

        if (Auth::check()) {

            $canViewForm  = false;
            $user = Auth::user();
            $user_roles = UserRole::where('user_id', $user->id)->get();

            foreach ($user_roles as $user_role) {
                $actualRole = Role::select('roleName')->where('id', $user_role->role_id)->first();
                //dd($actualRole);
                if ($actualRole->roleName == 'Accomodation Officer') {
                    $canViewForm  = true;
                    
                    break;
                }
            }

            if ($canViewForm  == true) {
               
                return $next($request);
            }
           
        } else {
            return redirect('/warn')->with('message', 'Access Denied');
        }
        return redirect('/warn')->with('message', 'Access Denied');
    }
}
