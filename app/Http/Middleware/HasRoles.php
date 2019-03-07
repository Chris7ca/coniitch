<?php

namespace App\Http\Middleware;

use Closure;

class HasRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = func_get_args();
        $roles = array_slice($roles, 2);

        foreach ( Auth()->user()->roles as $role_user ) {
            
            foreach ( $roles as $role_required ) {
                
                if( $role_user->key == $role_required ){
                    return $next($request);
                }

            }

        }
        
        abort(403, 'Acceso no permitido');
    }
}
