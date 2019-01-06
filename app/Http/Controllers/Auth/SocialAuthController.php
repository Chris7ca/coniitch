<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PersonalProfile;
use App\Http\Controllers\Controller;

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

            $full_name = explode(' ', $social_user->name);
            $size_name = sizeof($full_name);
            $first_name = $full_name[0];
            $second_name = ($size_name >= 4) ? $full_name[1] : '';
            $last_name = ($size_name >= 3) ? $full_name[$size_name - 2] : $full_name[$size_name - 1];
            $second_last_name = ($size_name >= 3) ? $full_name[$size_name - 1] : '';        

            // $congressman_role = Role::select('id')->where('key','congressman')->first();

            $user =  User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $social_user->email,
                'email_verified_at' => now(),
                'avatar' => $social_user->avatar_original,
                'method_to_register' => title_case($provider)
            ]);

            // if( $second_name != '' && $second_last_name != '' ) {

            //     $personal_profile = PersonalProfile::create([
            //         'user_id' => $user->id,
            //         'second_name' => $second_name,
            //         'second_last_name' => $second_last_name,
            //     ]);
            
            // }

            // $user->roles()->attach($congressman_role);
 
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