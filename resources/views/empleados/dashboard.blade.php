<!-- layouts.app'-->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Dashboard de Empleado</h4>
                        <span class="badge badge-primary">{{ Auth::user()->role }}</span>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- User Info -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="card-title">{{ Auth::user()->name }}</h5>
                                            <p class="card-text text-muted">{{ Auth::user()->email }}</p>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <form method="POST" action="{{ route('empleados.logout') }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    Cerrar Sesión
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title text-success">Activo</h5>
                                    <p class="card-text">Estado</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">0</h5>
                                    <p class="card-text">Tareas Pendientes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">0</h5>
                                    <p class="card-text">Notificaciones</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Information -->
                    @php
                        $empleado = App\Models\CredencialEmpleado::where('EMAIL_Empleado', Auth::user()->email)->first();
                    @endphp
                    
                    @if($empleado)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Información Personal</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nombre completo:</strong><br>
                                    {{ $empleado->NAME_Empleado }} {{ $empleado->SURNAME_Empleado }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>DNI:</strong><br>{{ $empleado->DNI_Empleado }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Email:</strong><br>{{ $empleado->EMAIL_Empleado }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Usuario:</strong><br>
                                    <code class="bg-light p-1 rounded">{{ $empleado->USER_Empleado }}</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Acciones Rápidas</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <button class="btn btn-outline-primary btn-block text-left">
                                        <i class="fas fa-calendar mr-2"></i>Ver Mi Horario
                                    </button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <button class="btn btn-outline-success btn-block text-left">
                                        <i class="fas fa-check-circle mr-2"></i>Solicitar Permisos
                                    </button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <button class="btn btn-outline-info btn-block text-left">
                                        <i class="fas fa-bullhorn mr-2"></i>Ver Comunicados
                                    </button>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <button class="btn btn-outline-warning btn-block text-left">
                                        <i class="fas fa-download mr-2"></i>Descargar Recibos
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection