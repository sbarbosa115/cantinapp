<?php

namespace App\Http\Controllers\Restaurant\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     * @var string
     */
    protected $redirectTo = '/99/order';


    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:employee', ['except' => ['logout']]);
    }

    /**
     * Default username to login in.
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Return the show login form.s
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm(){
        return view("restaurant.login.index");
    }

    /**
     * Logout the user for platform.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect('/99/login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard("employee");
    }


}
