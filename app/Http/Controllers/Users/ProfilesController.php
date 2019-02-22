<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    
    public function view()
    {
        return view('app.congressman.profiles');
    }

    public function show($id)
    {
        $profile = User::select(['id','first_name','last_name','email','method_to_register','created_at','avatar'])->with([
            'personal_profile',
            'academic_profile',
            'professional_profile'
        ])->findOrFail($id);

        return response()->json(['profile' => $profile]);
    }

}
