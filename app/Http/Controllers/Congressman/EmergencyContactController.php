<?php

namespace App\Http\Controllers\Congressman;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmergencyContact;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmergencyContact as EmergencyContactRequest;

class EmergencyContactController extends Controller
{
    
    public function edit()
    {
        $user = User::with('emergency_contact')->where('id', Auth()->user()->id)->first();
        return $user;
    }

    public function update(EmergencyContactRequest $request)
    {
        $user = User::with('emergency_contact')->where('id', Auth()->user()->id)->first();

        if($user->emergency_contact){
            $user->relationship = $request->relationship;
            $user->full_name = $request->full_name;
            $user->first_phone_number = $request->first_phone_number;
            $user->second_phone_number = $request->second_phone_number;
            $user->emergency_contact->save();
        } else {
            $user->has_emergency_contact = 1;
            $user->save();
            $user->emergency_contact()->create($request->all());
        }

        return response()->json(['message' => 'Informacón del contacto de emergencia actualizada']);
    }

}
