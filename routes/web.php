<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

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


Route::get('/tareas', [App\Http\Controllers\TareaController::class, 'index'])->name('tareas.index');


//STORE
Route::get('/tareas/create', [App\Http\Controllers\TareaController::class, 'create'])
->name('tareas.create');

Route::get('/tareas', [App\Http\Controllers\TareaController::class, 'store'])
->name('tareas.store');


//UPDATE
Route::get('/tareas/create', [App\Http\Controllers\TareaController::class, 'edit'])
->name('tareas.edit');

Route::get('/tareas', [App\Http\Controllers\TareaController::class, 'update'])
->name('tareas.update');


//DELETE
Route::get('/tareas/create', [App\Http\Controllers\TareaController::class, 'edit'])
->name('tareas.edit');

Route::get('/tareas/{tarea}', [App\Http\Controllers\TareaController::class, 'destroy'])
->name('tareas.destroy');


#CORRECCION
Route::resource('tareas', TareaController::class);