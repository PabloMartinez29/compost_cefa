<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {


        if (!auth()->check()) { 
            return redirect('/login'); 
        } 
 
        $userRole = auth()->user()->role;
        
        // Si el usuario no tiene rol, asignar por defecto 'aprendiz'
        if (is_null($userRole)) {
            auth()->user()->update(['role' => 'aprendiz']);
            $userRole = 'aprendiz';
        }
        
        if ($userRole !== $role) { 
            abort(403, 'Acceso no autorizado.'); 
        } 


        return $next($request);
        
    }
}
