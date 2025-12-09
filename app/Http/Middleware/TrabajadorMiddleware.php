<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Importa la clase Auth


class TrabajadorMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->id_cargo==2) {
            return $next($request);
        }

        return redirect('/login'); // Redirige a una página de inicio o error si no es administrador
    }
}
