<?php

namespace App\Http\Middleware;

use Closure;

class HasProfiles
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

        $exept_routes = [
            'app.profiles.view',
            'app.profiles.personal.edit',
            'app.profiles.personal.update',
            'app.profiles.academic.edit',
            'app.profiles.academic.update',
            'app.profiles.professional.edit',
            'app.profiles.professional.update',
            'app.emergency.contact.edit',
            'app.emergency.contact.update',
            'app.user.password.update'
        ];

        $has_profiles = (Auth()->user()->has_personal_profile 
            && Auth()->user()->has_academic_profile 
            && Auth()->user()->has_emergency_contact);

        if (!in_array($request->route()->getName(), $exept_routes) && !$has_profiles) {
            
            return redirect('app/perfil/editar')
                    ->with('doesntHaveProfiles', 'Por favor, antes de continuar, completa la información correspondiente a cada uno de los perfiles que a continuación se muestran.');
        }

        return $next($request);
    }
}
