<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    
    public function password(Password $request)
    {
        Auth()->user()->password = Hash::make($request->password);
        Auth()->user()->save();
        
        return response()->json(['message' => 'Contraseña actualizada']);
    }

}
