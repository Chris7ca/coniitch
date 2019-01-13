<?php

namespace App\Http\Controllers\Congressman;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionalProfile;

class ProfessionalProfileController extends Controller
{
    
    public function edit()
    {
        $user = User::with('professional_profile')->where('id', Auth()->user()->id)->first();
        return $user;
    }

    public function update(ProfessionalProfile $request)
    {
        $user = User::with('professional_profile')->where('id', Auth()->user()->id)->first();

        if ($user->professional_profile) {
            $user->professional_profile->job_title = $request->job_title;
            $user->professional_profile->institute = $request->institute;
            $user->professional_profile->country = $request->country;
            $user->professional_profile->state = $request->state;
            $user->professional_profile->save();
        } else {
            $user->professional_profile()->create($request->all());
        }

        return response()->json(['message' => 'Información profesional actualizada']);
    }

}
