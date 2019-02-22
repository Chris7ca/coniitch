<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PersonalProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SocialAuthController extends Controller
{
    
    
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect(); // Redireccionamos al servicio
    }
    
    
    public function handleProviderCallback($provider) // Resolver    
    {
        
        $social_user = Socialite::driver($provider)->user(); 
        // dd($social_user);
        
        
        if ($user = User::where('email', $social_user->email)->first()) 
        { 
            return $this->authAndRedirect($user); // Login y redirección
        } 
        else 
        {  
            // En caso de que no exista creamos un nuevo usuario con sus datos.

            $name = explode(' ', $data['name']);

            $congressman_role = Role::select('id')->where('key','congressman')->first();

            $user =  User::create([
                'first_name' => $name[0],
                'last_name' => $name[1],
                'email' => $social_user->email,
                'email_verified_at' => now(),
                'avatar' => $social_user->avatar_original,
                'method_to_register' => title_case($provider)
            ]);

            $user->roles()->attach($congressma_role);

            Notification::send($work->registered_user, new RegisteredUser($user));
            Mail::to('finanzas.coniitch@uaem.mx')->queue(new RegisteredUserMail($work));

            return $this->authAndRedirect($user); // Login y redirección
        }
    }
 
    // Login y redirección
    public function authAndRedirect($user)
    {
        Auth::login($user);
 
        return redirect()->to('/app');
    }

}