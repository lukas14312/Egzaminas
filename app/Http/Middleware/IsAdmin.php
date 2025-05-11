<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user() || !auth()->user()->hasRole('admin')) {
            return redirect('/'); // Grąžinkite į pagrindinį puslapį, jei vartotojas nėra administratorius
        }
    
        return $next($request);
    }
    
}
