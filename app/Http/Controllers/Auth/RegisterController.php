<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\RegisteredUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\RegisteredUser as RegisteredUserMail;

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
        $name = explode(' ', $data['name']);

        $roles = Role::select('id')->whereIn('key', ['congressman','professional'])->get();

        $user =  User::create([
            'first_name' => $name[0],
            'last_name' => $name[1],
            'email' => $data['email'],
            'method_to_register' => 'Traditional',
            'password' => Hash::make($data['password']),
        ]);

        $user->roles()->attach($roles);

        $notifiables_users = getUsersByRole('finances'); 

        Notification::send($notifiables_users, new RegisteredUser($user));
        Mail::to('finanzas.coniitch@uaem.mx')->queue(new RegisteredUserMail($user));

        return $user;

    }

}
