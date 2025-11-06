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

// RUTAS DE AUTENTICACIÓN (SOLO PARA CLIENTES)
Auth::routes();





// RUTA HOME PRINCIPAL  
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// RUTAS PÚBLICAS PARA LOGIN DE PERSONAL INTERNO
Route::prefix('empleados')->group(function () {
    Route::get('/login', function () {
        return view('empleados.login');
    })->name('empleados.login');
    
    Route::post('/login', [EmpleadoController::class, 'login'])->name('empleados.login.submit');
});




// RUTAS PARA ADMINISTRADORES Y GERENTES (CON MIDDLEWARE DE ROL)
Route::middleware(['auth', 'role:admin,gerente'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::resource('empleados', EmpleadoController::class)->names([
        'index' => 'empleados.index',
        'create' => 'empleados.create',
        'store' => 'empleados.store',
        'show' => 'empleados.show'
    ]);
    
    Route::get('/empleados/{id}/copiar/{tipo}', [EmpleadoController::class, 'copiarCredencial'])
    ->name('empleados.copiar');
});




// RUTAS PARA DASHBOARD DE EMPLEADOS
Route::middleware(['auth', 'role:empleado'])->group(function () {
    Route::get('/empleados/dashboard', function () {
        return view('empleados.dashboard');
    })->name('empleados.dashboard');
    
    Route::post('/empleados/logout', [EmpleadoController::class, 'logout'])->name('empleados.logout');
});




// RUTAS PARA DASHBOARD DE GERENTES  
Route::middleware(['auth', 'role:gerente'])->group(function () {
    Route::get('/gerentes/dashboard', function () {
        return view('gerentes.dashboard');
    })->name('gerentes.dashboard');
});




// RUTA PARA DASHBOARD DE CLIENTES
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/clientes/dashboard', function () {
        return view('clientes.dashboard');
    })->name('clientes.dashboard');
});