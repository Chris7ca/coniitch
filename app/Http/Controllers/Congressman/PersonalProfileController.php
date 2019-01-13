<?php

namespace App\Http\Controllers\Congressman;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Avatar;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalProfile;

class PersonalProfileController extends Controller
{
    
    public function avatar(Avatar $request)
    {
        Auth()->user()->avatar = $request->avatar->store('public/avatars');
        Auth()->user()->save();

        return response()->json(['message' => 'Imagen de perfil actualizada']);
    }
    
    public function edit()
    {
        $user = User::with('personal_profile')->where('id', Auth()->user()->id)->first();
        return $user;
    }

    public function update(PersonalProfile $request)
    {
        $user = User::with('personal_profile')->where('id', Auth()->user()->id)->first();

        $user->has_personal_profile = 1;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        if ($user->personal_profile != null) 
        {
            $user->personal_profile->second_name = $request->second_name;
            $user->personal_profile->second_last_name = $request->second_last_name;
            $user->personal_profile->gender = $request->gender;
            $user->personal_profile->birthdate = $request->birthdate;
            $user->personal_profile->country = $request->country;
            $user->personal_profile->state = $request->state;
            $user->personal_profile->phone_number = $request->phone_number;
            $user->personal_profile->save();
        } 
        else 
        {
            $user->personal_profile()->create([
                'user_id' => $user->id,
                'second_name' => $request->second_name,
                'second_last_name' => $request->second_last_name,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'country' => $request->country,
                'state' => $request->state,
                'phone_number' => $request->phone_number,
            ]);
        }      

        return response()->json(['message' => 'Información personal actualiazada']);

    }

}
