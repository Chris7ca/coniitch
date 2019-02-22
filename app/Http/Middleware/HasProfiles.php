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
            'app.users.profile.edit',
            'app.users.profile.personal.edit',
            'app.users.profile.personal.update',
            'app.congressman.profile.academic.edit',
            'app.congressman.profile.academic.update',
            'app.congressman.profile.professional.edit',
            'app.congressman.profile.professional.update',
            'app.congressman.emergency.contact.edit',
            'app.congressman.emergency.contact.update',
            'app.congressman.invoicing.edit',
            'app.congressman.invoicing.update',
            'app.users.password.update'
        ];

        $has_profiles = (Auth()->user()->has_personal_profile 
            && Auth()->user()->has_academic_profile 
            && Auth()->user()->has_emergency_contact);

        if (!in_array($request->route()->getName(), $exept_routes) && !$has_profiles) {
            
            return redirect('app/usuarios/perfiles/editar')
                    ->with('doesntHaveProfiles', 'Por favor, antes de continuar, completa la información correspondiente a cada uno de los perfiles que a continuación se muestran.');
        }

        return $next($request);
    }
}
