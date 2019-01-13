<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    
    public function index()
    {
        return view('app.index');
    }

    public function password(Password $request)
    {
        Auth()->user()->password = Hash::make($request->password);
        Auth()->user()->save();
        
        return response()->json(['message' => 'Contraseña actualizada']);
    }

}
