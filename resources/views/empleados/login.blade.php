@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="login-card">
                <div class="login-header">
                    <h2>Portal de Empleados</h2>
                    <p class="mb-0">Ingresa con tus credenciales</p>
                </div>
                
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('empleados.login.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input id="usuario" type="text" 
                                   class="form-control @error('usuario') is-invalid @enderror" 
                                   name="usuario" value="{{ old('usuario') }}" 
                                   required autofocus placeholder="ejemplo.nombre">
                            @error('usuario')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required placeholder="Tu DNI">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Ingresar al Portal
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ url('/') }}" class="text-decoration-none">
                            ← Volver al sitio principal
                        </a>
                    </div>

                    <div class="mt-4 p-3 bg-light rounded">
                        <h6>¿Problemas para ingresar?</h6>
                        <p class="small mb-0">
                            Contacta al administrador del sistema para verificar tus credenciales.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection