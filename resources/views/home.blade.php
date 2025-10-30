@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5 class="text-success">¡Bienvenido, {{ Auth::user()->name }}!</h5>
                        <p class="mb-0">Rol: <span class="badge bg-primary">{{ Auth::user()->role }}</span></p>
                        <p class="mb-3">Email: {{ Auth::user()->email }}</p>
                    </div>

                    {{ __('You are logged in!') }}

                    <!-- OPCIONES PARA ADMINISTRADORES -->
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'gerente')
                    <div class="mt-4 p-4 bg-light rounded">
                        <h6 class="mb-3">🔧 Panel de Administración</h6>
                        
                        <div class="row">
                            @if(Auth::user()->role === 'admin')
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('empleados.index') }}" class="btn btn-primary w-100">
                                    👥 Gestionar Empleados
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('empleados.create') }}" class="btn btn-success w-100">
                                    ➕ Registrar Empleado
                                </a>
                            </div>
                            @endif
                            
                            @if(Auth::user()->role === 'gerente')
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('gerentes.dashboard') }}" class="btn btn-info w-100">
                                    📊 Dashboard Gerente
                                </a>
                            </div>
                            @endif
                            
                            @if(Auth::user()->role === 'admin')
                            <div class="col-md-6 mb-3">
                                <button class="btn btn-secondary w-100" disabled>
                                    ⚙️ Configuración (Próximamente)
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- OPCIONES PARA EMPLEADOS -->
                    @if(Auth::user()->role === 'empleado')
                    <div class="mt-4">
                        <a href="{{ route('empleados.dashboard') }}" class="btn btn-outline-primary">
                            🏢 Ir a Mi Dashboard de Empleado
                        </a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection