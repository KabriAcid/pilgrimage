<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;

use App\Models\UserRole;

class SpaceAlloccationManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)

    {
        

        if (Auth::check()) {

            $canAllocateSpace  = false;
            $user = Auth::user();
            $user_roles = UserRole::where('user_id', $user->id)->get();
            //dd($user_roles);

            foreach ($user_roles as $user_role) {
                $actualRole = Role::select('roleName')->where('id', $user_role->role_id)->first();
                //dd($actualRole);
                                
                if ($actualRole->roleName == 'Allocation Officer') {
                    $canAllocateSpace   = true;
                    
                    break;
                }
            }

            if ($canAllocateSpace   == true) {
               
                return $next($request);
            }
           
        } else {
            return redirect('/warn')->with('message', 'Access Denied');
        }
        return redirect('/warn')->with('message', 'Access Denied');
    }
}
