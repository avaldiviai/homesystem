<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirige basado en el id_cargo del usuario autenticado
                $user = Auth::user();

                if ($user->id_cargo == 1) {
                    return redirect('/dashboard'); // Superadmin
                }

                if ($user->id_cargo == 2) {
                    return redirect('/trabajador/propiedades'); // Trabajador
                }
                if ($user->id_cargo == 3) {
                    return redirect('/obrero/propiedades'); // Obrero
                }

                // Puedes agregar más condiciones según otros roles
            }
               
        }

        return $next($request);
    }
}
