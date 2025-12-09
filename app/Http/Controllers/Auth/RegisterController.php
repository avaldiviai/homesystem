<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
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
     * Redirect any requests to /register to /login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showRegistrationForm()
    {
        // Redirige a /login cuando intenten acceder a /register
        return redirect('/login');
    }
}
