<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

           // Definir jerarquía de roles
           $hierarchy = [
            'admin' => 4,
            'gerente' => 3,
            'empleado' => 2,
            'cliente' => 1
        ];


        $userRoleLevel = $hierarchy[$user->role] ?? 0;
        $requiredRoleLevel = $hierarchy[$role] ?? 0;

        if ($userRoleLevel >= $requiredRoleLevel) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'No tienes permisos para acceder a esta página.');
    }
}