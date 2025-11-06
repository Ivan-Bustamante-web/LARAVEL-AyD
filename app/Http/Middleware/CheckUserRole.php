<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        
        // Si es empleado o gerente, redirigir a su portal específico
        if ($user->role === 'empleado' || $user->role === 'gerente') {
            Auth::logout(); // Cerrar sesión
            return redirect()->route('empleados.login')
                ->withErrors(['email' => 'Los empleados y gerentes deben usar el portal de empleados.']);
        }

        return $next($request);
    }
}