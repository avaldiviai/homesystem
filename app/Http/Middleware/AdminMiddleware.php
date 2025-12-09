<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Importa la clase Auth


class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->id_cargo==1) {
            return $next($request);
        }

        return redirect('/'); // Redirige a una página de inicio o error si no es administrador
    }
}
