<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Notifications\Register;
use App\User;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\View\View;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(
        array $data
    ): \Illuminate\Contracts\Validation\Validator {
        return \Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data): User
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->notify(new Register($user));

        return $user;
    }

    /**
     * Show the application registration form.
     */
    public function showRegistrationForm(): View
    {
        return view('frontend.auth.register');
    }
}
