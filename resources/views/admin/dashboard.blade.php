@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dashboard de Administrador</h3>
                    <p class="card-subtitle text-muted">Panel de control completo del sistema</p>
                </div>
                <div class="card-body">
                    <!-- Estadísticas Rápidas -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ App\Models\User::count() }}</h3>
                                    <p>Total Usuarios</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ App\Models\CredencialEmpleado::count() }}</h3>
                                    <p>Empleados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <a href="{{ route('empleados.index') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ App\Models\User::where('role', 'cliente')->count() }}</h3>
                                    <p>Clientes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ App\Models\User::whereIn('role', ['gerente', 'admin'])->count() }}</h3>
                                    <p>Administradores</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones de Administrador -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Acciones Rápidas</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6">
                                            <a href="{{ route('empleados.index') }}" class="btn btn-info btn-block mb-2">
                                                <i class="fas fa-users mr-2"></i>Gestionar Empleados
                                            </a>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <a href="{{ route('empleados.create') }}" class="btn btn-success btn-block mb-2">
                                                <i class="fas fa-plus mr-2"></i>Registrar Empleado
                                            </a>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <button class="btn btn-warning btn-block mb-2">
                                                <i class="fas fa-chart-pie mr-2"></i>Generar Reportes
                                            </button>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <button class="btn btn-purple btn-block mb-2">
                                                <i class="fas fa-cog mr-2"></i>Configuración
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información del Sistema -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Usuarios por Rol</h3>
                                </div>
                                <div class="card-body">
                                    @php
                                        $roles = ['admin', 'gerente', 'empleado', 'cliente'];
                                    @endphp
                                    <ul class="list-group list-group-flush">
                                        @foreach($roles as $role)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="text-capitalize">{{ $role }}s</span>
                                            <span class="badge badge-primary badge-pill">
                                                {{ App\Models\User::where('role', $role)->count() }}
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Información Técnica</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Laravel</span>
                                            <span class="badge badge-secondary">v{{ Illuminate\Foundation\Application::VERSION }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>PHP</span>
                                            <span class="badge badge-secondary">v{{ PHP_VERSION }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Base de Datos</span>
                                            <span class="badge badge-secondary text-capitalize">{{ config('database.default') }}</span>
                                        </li>
                                    </ul>
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