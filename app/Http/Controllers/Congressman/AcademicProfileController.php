<?php

namespace App\Http\Controllers\Congressman;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicProfile;

class AcademicProfileController extends Controller
{
    
    public function edit()
    {
        $user = User::with('academic_profile')->where('id', Auth()->user()->id)->first();
        return $user;
    }

    public function update(AcademicProfile $request)
    {
        $user = User::with('academic_profile')->where('id', Auth()->user()->id)->first();
        
        
        if ($user->academic_profile != null)
        {
            $user->academic_profile->career = $request->career;
            $user->academic_profile->institute = $request->institute;
            $user->academic_profile->faculty = $request->faculty;
            $user->academic_profile->country = $request->country;
            $user->academic_profile->state = $request->state;
            $user->academic_profile->document = ($request->hasFile('document')) ? $request->document->store('public/files/students') : null;
            $user->academic_profile->save();
        } 
        else 
        {
            $document = ($request->hasFile('document')) ? $request->document->store('public/files/students') : null;
            $user->has_academic_profile = 1;
            $user->save();
            $user->academic_profile()->create([
                'career' => $request->career,
                'institute' => $request->institute,
                'faculty' => $request->faculty,
                'country' => $request->country,
                'state' => $request->state,
                'document' => $document,
            ]);
        }
        
        return response()->json(['message' => 'Información académica actualizada']);
    }

}
