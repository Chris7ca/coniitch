<?php

namespace App\Http\Controllers\Root;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('hasRoles:root');
    }
    
    public function view()
    {
        return view('app.root.users');
    }

    public function index()
    {
        $users = User::with(['personal_profile:id,second_name,second_last_name','roles:id,key,display_name'])
            ->paginate(10);
        
        return $users;
    }

    public function search(Request $request)
    {
        $query = $request->query('search');
        $users = User::with(['personal_profile:id,second_name,second_last_name','roles:id,display_name'])
            ->where('first_name', 'like', '%' . $query . '%')
            ->orWhere('last_name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->get();
            
        return $users;
    }

    public function store(CreateUser $request)
    {
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'has_academic_profile' => true,
            'has_emergency_contact' => true,
            'password' => Hash::make($request->password)
        ]);

        $roles = [];

        foreach ( $request->roles as $role ) {
            array_push($roles, decode_id($role));
        }
        
        $user->roles()->attach($roles);

        return response()->json(['message' => 'Usuario creado']);
    }

    public function edit($id)
    {
        $user = User::select(['id','first_name','last_name','email'])
            ->with('roles:id,key,display_name')->findOrFail($id);

        return $user;
    }

    public function update(UpdateUser $request, $id)
    {
        $user = User::select(['id','first_name','last_name','email'])
            ->with('roles:id')->findOrFail($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if ( $request->filled('password') ) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        $roles = [];

        foreach ( $request->roles as $role ) {
            array_push($roles, decode_id($role));
        }

        $user->roles()->sync($roles);

        $user->refresh();

        return $user;

    }

    public function delete($id)
    {
        User::destroy($id);
        return response()->json(['message' => 'Usuario eliminado']);
    }

    public function statistics()
    {
        $total = User::count();
        $records = User::whereNotNull('method_to_register')->count();
        $validate_records = User::whereNotNull('email_verified_at')->whereNotNull('method_to_register')->count();
        $traditional_records = User::where('method_to_register', 'Traditional')->count();
        $google_records = User::where('method_to_register', 'Google')->count();
        $facebook_records = User::where('method_to_register', 'Facebook')->count();

        return response()->json([ 
            'total' => $total,
            'records' => $records,
            'validate_records' => $validate_records,
            'traditional_records' => $traditional_records,
            'google_records' => $google_records,
            'facebook_records' => $facebook_records
        ]);
    }

}
