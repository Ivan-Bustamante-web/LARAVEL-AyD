<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// RUTAS PÚBLICAS PARA LOGIN DE EMPLEADOS Y CLIENTES
Route::prefix('empleados')->group(function () {
    Route::get('/login', function () {
        return view('empleados.login');
    })->name('empleados.login');
    
    Route::post('/login', [EmpleadoController::class, 'login'])->name('empleados.login.submit');
});

// RUTAS PARA CLIENTES (a implementar después)
Route::prefix('clientes')->group(function () {
    Route::get('/login', function () {
        return view('clientes.login'); // Crearemos esta vista después
    })->name('clientes.login');
});

// RUTAS PARA ADMINISTRADORES Y GERENTES (gestión de empleados)
Route::middleware(['auth', 'role:gerente'])->prefix('admin')->group(function () {
    Route::resource('empleados', EmpleadoController::class)->names([
        'index' => 'empleados.index',
        'create' => 'empleados.create',
        'store' => 'empleados.store',
        'show' => 'empleados.show'
    ]);
    
    Route::post('/empleados/{id}/copiar/{tipo}', [EmpleadoController::class, 'copiarCredencial'])
         ->name('empleados.copiar');
});

// RUTAS PARA DASHBOARD DE EMPLEADOS
Route::middleware(['auth', 'role:empleado'])->group(function () {
    Route::get('/empleados/dashboard', function () {
        return view('empleados.dashboard');
    })->name('empleados.dashboard');
    
    Route::post('/empleados/logout', [EmpleadoController::class, 'logout'])->name('empleados.logout');
});

// RUTAS PARA DASHBOARD DE CLIENTES (a implementar después)
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/clientes/dashboard', function () {
        return view('clientes.dashboard');
    })->name('clientes.dashboard');
});

// RUTAS PARA DASHBOARD DE GERENTES
Route::middleware(['auth', 'role:gerente'])->group(function () {
    Route::get('/gerentes/dashboard', function () {
        return view('gerentes.dashboard');
    })->name('gerentes.dashboard');
});