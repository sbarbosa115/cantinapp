<?php

namespace App\Http\Controllers\Restaurant\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/restaurant/order';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:employee', ['except' => ['logout']]);
    }

    /**
     * Default username to login in.
     *
     * @return string
     */
    public function username(): string
    {
        return 'username';
    }

    /**
     * Return the show login form.s.
     *
     * @return Factory|View
     */
    public function showLoginForm()
    {
        return view('restaurant.login.index');
    }

    /**
     * Logout the user for platform.
     *
     * @return RedirectResponse|Redirector
     */
    public function logout()
    {
        Auth::guard('employee')->logout();

        return redirect()->route('restaurant.login');
    }

    /**
     * Get the guard to be used during authentication.
     */
    protected function guard(): StatefulGuard
    {
        return Auth::guard('employee');
    }
}
