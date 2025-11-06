@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Registrar Nuevo Empleado</h3>
                    <div class="card-tools">
                        <a href="{{ route('empleados.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Volver a la lista
                        </a>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('empleados.store') }}">
                    @csrf
                    <div class="card-body">
                        
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Error en el formulario</h5>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NAME_Empleado">Nombre *</label>
                                    <input type="text" class="form-control @error('NAME_Empleado') is-invalid @enderror" 
                                           id="NAME_Empleado" name="NAME_Empleado" 
                                           value="{{ old('NAME_Empleado') }}" 
                                           placeholder="Ingrese el nombre" required>
                                    @error('NAME_Empleado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="SURNAME_Empleado">Apellido *</label>
                                    <input type="text" class="form-control @error('SURNAME_Empleado') is-invalid @enderror" 
                                           id="SURNAME_Empleado" name="SURNAME_Empleado" 
                                           value="{{ old('SURNAME_Empleado') }}" 
                                           placeholder="Ingrese el apellido" required>
                                    @error('SURNAME_Empleado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DNI_Empleado">DNI *</label>
                                    <input type="text" class="form-control @error('DNI_Empleado') is-invalid @enderror" 
                                           id="DNI_Empleado" name="DNI_Empleado" 
                                           value="{{ old('DNI_Empleado') }}" 
                                           placeholder="Ingrese el DNI" required maxlength="8">
                                    @error('DNI_Empleado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="form-text text-muted">8 dígitos sin puntos</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EMAIL_Empleado">Email *</label>
                                    <input type="email" class="form-control @error('EMAIL_Empleado') is-invalid @enderror" 
                                           id="EMAIL_Empleado" name="EMAIL_Empleado" 
                                           value="{{ old('EMAIL_Empleado') }}" 
                                           placeholder="correo@ejemplo.com" required>
                                    @error('EMAIL_Empleado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Rol del Empleado *</label>
                                    <select class="form-control @error('role') is-invalid @enderror" 
                                            id="role" name="role" required>
                                        <option value="">Seleccione un rol</option>
                                        <option value="empleado" {{ old('role') == 'empleado' ? 'selected' : '' }}>Empleado</option>
                                        <option value="gerente" {{ old('role') == 'gerente' ? 'selected' : '' }}>Gerente</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="form-text text-muted">
                                        <strong>Empleado:</strong> Acceso básico al sistema | 
                                        <strong>Gerente:</strong> Puede gestionar otros empleados
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Información de credenciales automáticas -->
                        <div class="alert alert-info">
                            <h5><i class="icon fas fa-info"></i> Información Importante</h5>
                            Las credenciales de acceso (usuario y contraseña) se generarán automáticamente.
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Registrar Empleado
                        </button>
                        <a href="{{ route('empleados.index') }}" class="btn btn-default float-right">
                            <i class="fas fa-times mr-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection