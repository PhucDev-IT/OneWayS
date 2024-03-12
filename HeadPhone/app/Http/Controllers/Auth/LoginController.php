<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    // public function login(Request $request)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // Attempt to log the user in
    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         // Check if the user's account is active
    //         if (Auth::user()->is_active == 1) {
    //             // Redirect the user to the intended destination
    //             return redirect()->intended('/');
    //         } else {
    //             // Log the user out and show a message that the account is locked
    //             Auth::logout();
    //             return back()->with('status', 'Your account is locked.');
    //         }
    //     }

    //     // If unsuccessful, redirect back to the login form with an error message
    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }

}
