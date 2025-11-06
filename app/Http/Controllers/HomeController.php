<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
$user = Auth::user();
        
        // Redireccionar según el rol
        switch ($user->role) {
            case 'admin':
                case 'admin':
                return redirect()->route('admin.dashboard');
            case 'gerente':
                return redirect()->route('gerentes.dashboard');
            case 'empleado':
                return redirect()->route('empleados.dashboard');
            case 'cliente':
                return redirect()->route('clientes.dashboard');
            default:
                return view('home');
        }
    }
}