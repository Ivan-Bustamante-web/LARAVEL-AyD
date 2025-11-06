<!-- layouts.app'-->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Dashboard de Cliente</h4>
                        <span class="badge badge-success">{{ Auth::user()->role }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Información del Cliente -->
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Tu Información</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nombre:</strong><br>{{ Auth::user()->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Email:</strong><br>{{ Auth::user()->email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Rol:</strong><br>{{ Auth::user()->role }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Miembro desde:</strong><br>{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones para Clientes -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <i class="fas fa-shopping-cart fa-2x text-primary mb-3"></i>
                                    <h5 class="card-title">Mis Pedidos</h5>
                                    <p class="card-text text-muted">Ver historial de pedidos</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <i class="fas fa-user fa-2x text-success mb-3"></i>
                                    <h5 class="card-title">Mi Perfil</h5>
                                    <p class="card-text text-muted">Editar información personal</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <i class="fas fa-credit-card fa-2x text-purple mb-3"></i>
                                    <h5 class="card-title">Métodos de Pago</h5>
                                    <p class="card-text text-muted">Gestionar formas de pago</p>
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