@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Lista de Empleados Registrados</h4>
                    <a href="{{ route('empleados.create') }}" class="btn btn-primary">
                        Registrar Nuevo Empleado
                    </a>
                </div>

                <div class="card-body">
                    <!-- Filtros -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('empleados.index') }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="nombre" class="form-control" 
                                               placeholder="Filtrar por nombre" value="{{ request('nombre') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="apellido" class="form-control" 
                                               placeholder="Filtrar por apellido" value="{{ request('apellido') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="dni" class="form-control" 
                                               placeholder="Filtrar por DNI" value="{{ request('dni') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-outline-primary">Filtrar</button>
                                        <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabla de empleados -->
                    @if($empleados->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>DNI</th>
                                        <th>Email</th>
                                        <th>Usuario</th>
                                        <th>Contraseña</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($empleados as $empleado)
                                        <tr>
                                            <td>{{ $empleado->ID_Empleado }}</td>
                                            <td>{{ $empleado->NAME_Empleado }}</td>
                                            <td>{{ $empleado->SURNAME_Empleado }}</td>
                                            <td>{{ $empleado->DNI_Empleado }}</td>
                                            <td>{{ $empleado->EMAIL_Empleado }}</td>
                                            <td>
                                                <span class="user-field">{{ $empleado->USER_Empleado }}</span>
                                                <button class="btn btn-sm btn-outline-copy" 
                                                        data-type="usuario" 
                                                        data-id="{{ $empleado->ID_Empleado }}">
                                                    📋 Copiar
                                                </button>
                                            </td>
                                            <td>
                                                <span class="text-muted">••••••••</span>
                                                <button class="btn btn-sm btn-outline-copy" 
                                                        data-type="contrasena" 
                                                        data-id="{{ $empleado->ID_Empleado }}">
                                                    📋 Copiar
                                                </button>
                                            </td>
                                            <td>
                                                <a href="{{ route('empleados.show', $empleado->ID_Empleado) }}" 
                                                   class="btn btn-sm btn-info">
                                                    Ver Detalles
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            No se encontraron empleados registrados.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para copiar al portapapeles -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyButtons = document.querySelectorAll('.btn-outline-copy');
    
    copyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tipo = this.getAttribute('data-type');
            const id = this.getAttribute('data-id');
            
            fetch(`/admin/empleados/${id}/copiar/${tipo}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
            })
            .then(response => response.json())
            .then(data => {
                // Copiar al portapapeles
                navigator.clipboard.writeText(data.valor).then(function() {
                    // Mostrar mensaje de éxito
                    const originalText = button.textContent;
                    button.textContent = '✓ Copiado';
                    button.classList.remove('btn-outline-copy');
                    button.classList.add('btn-success');
                    
                    setTimeout(() => {
                        button.textContent = originalText;
                        button.classList.remove('btn-success');
                        button.classList.add('btn-outline-copy');
                    }, 2000);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al copiar al portapapeles');
            });
        });
    });
});
</script>

<style>
.btn-outline-copy {
    border: 1px solid #6c757d;
    color: #6c757d;
    margin-left: 5px;
}

.btn-outline-copy:hover {
    background-color: #6c757d;
    color: white;
}

.user-field {
    font-family: monospace;
    background-color: #f8f9fa;
    padding: 2px 6px;
    border-radius: 3px;
}
</style>
@endsection