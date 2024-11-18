<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Exemple : vérifier si l'utilisateur est administrateur
        if (auth()->user() && auth()->user()->is_admin) {
            return $next($request);
        }

        return redirect('/'); // Redirige si l'utilisateur n'est pas admin
    }
}
