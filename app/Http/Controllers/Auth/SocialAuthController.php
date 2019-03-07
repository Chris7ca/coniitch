<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
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
        
        
        if ($user = User::where('email', $social_user->email)->first()) 
        { 
            return $this->authAndRedirect($user); // Login y redirección
        } 
        else 
        {  
            // En caso de que no exista creamos un nuevo usuario con sus datos.

            $name = explode(' ', $data['name']);

            $roles = Role::select('id')->whereIn('key', ['congressman','professional'])->get();

            $user =  User::create([
                'uuid' => Str::uuid(),
                'first_name' => $name[0],
                'last_name' => $name[1],
                'email' => $social_user->email,
                'email_verified_at' => now(),
                'avatar' => $social_user->avatar_original,
                'method_to_register' => title_case($provider)
            ]);

            $user->roles()->attach($roles);

            $notifiables_users = getUsersByRole('finances'); 

            Notification::send($notifiables_users, new RegisteredUser($user));
            Mail::to('finanzas.coniitch@uaem.mx')->queue(new RegisteredUserMail($user));

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