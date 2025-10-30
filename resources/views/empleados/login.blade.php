<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 2rem;
            text-align: center;
        }
        .btn-empleado {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }
        .btn-empleado:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            color: white;
        }
    </style>
</head>
<body>
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
                                <button type="submit" class="btn btn-empleado btn-lg">
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
                                Usuario: nombre.apellido | Contraseña: Tu DNI
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>