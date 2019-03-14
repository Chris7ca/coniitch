<?php

namespace App\Http\Controllers\Users;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Requests\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    
    public function password(Password $request)
    {
        Auth()->user()->password = Hash::make($request->password);
        Auth()->user()->save();
        
        return response()->json(['message' => 'Contraseña actualizada']);
    }

    public function documents()
    {
        $documents = Document::where('user_id', Auth()->user()->id)->get();

        return view('app.documents', compact('documents'));
    }

}
