<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;

use App\Models\UserRole;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)

    {
        

        if (Auth::check()) {

            $isSuperAdmin  = false;
            $user = Auth::user();
            $user_roles = UserRole::where('user_id', $user->id)->get();
            //dd($user_roles);

            foreach ($user_roles as $user_role) {
                $actualRole = Role::select('roleName')->where('id', $user_role->role_id)->first();
                //dd($actualRole);
                                
                if ($actualRole->roleName == 'Super Admin' || $actualRole->roleName == 'Director Operations') {
                    $isSuperAdmin    = true;
                    
                    break;
                }
            }

            if ($isSuperAdmin    == true) {
               
                return $next($request);
            }
           
        } else {
            return redirect('/warn')->with('message', 'Access Denied');
        }
        return redirect('/warn')->with('message', 'Access Denied');
    }
}
