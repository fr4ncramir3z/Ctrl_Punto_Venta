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
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $rol): Response
    {
        // (!auth()->check() -- Verifica que el usuario este autenticado
        //if (!auth()->check() || auth()->user()->rol !== $rol){
        if (!$request->user() || $request->user()->rol !== $rol) {

            abort(403, 'Permisos insuficientes para acceder. ');
        }
        
        return $next($request);
    }
}
