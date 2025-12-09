<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware para invitados excepto cuando se llama al método logout
        $this->middleware('guest')->except('logout');
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        // Asegúrate de que el usuario esté autenticado antes de acceder a Auth::user()
        if (Auth::check()) {
            // Redirige según el id_cargo del usuario
            if (Auth::user()->id_cargo === 1) {
                return '/dashboard'; // Superadmin
            }

            if (Auth::user()->id_cargo === 2) {
                return '/trabajador/propiedades'; // Trabajador
            }
            
            if (Auth::user()->id_cargo === 3) {
                return '/obrero/propiedades'; // Trabajador
            }

            // Puedes agregar más redirecciones basadas en otros valores de id_cargo aquí.
        }

        // Si no hay coincidencia o el usuario no está autenticado, redirige al login
        return '/login';
    }
}
