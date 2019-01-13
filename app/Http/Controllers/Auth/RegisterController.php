<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/app';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'regex' => 'La contraseña debe de tener mínimo 8 caracteres, una letra mayúscula, una letra minúscula y un dígito',
            'unique' => 'Ya existe una cuenta asociada a este correo electrónico'
        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'privacy_notice' => ['required','accepted'],
            'password' => ['required', 'regex:/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,}$/'],
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        $full_name = explode(' ', $data['name']);
        $size_name = sizeof($full_name);
        $first_name = $full_name[0];
        $second_name = ($size_name >= 4) ? $full_name[1] : '';
        $last_name = ($size_name >= 3) ? $full_name[$size_name - 2] : $full_name[$size_name - 1];
        $second_last_name = ($size_name >= 3) ? $full_name[$size_name - 1] : '';    

        // $congressma_role = Role::select('id')->where('key','congressman')->first();

        $user =  User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $data['email'],
            'method_to_register' => 'Traditional',
            'password' => Hash::make($data['password']),
        ]);

        // if( $second_name != '' && $second_last_name != '' ) {

        //     $personal_profile = PersonalProfile::create([
        //         'user_id' => $user->id,
        //         'second_name' => $second_name,
        //         'second_last_name' => $second_last_name,
        //     ]);
        
        // }

        // $user->roles()->attach($congressma_role);

        return $user;

    }

}
