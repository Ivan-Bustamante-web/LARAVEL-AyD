<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles del Empleado - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-800">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @auth
                            <a href="{{ url('/home') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                            <a href="{{ route('empleados.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Empleados</a>
                        @else
                            <a href="{{ route('empleados.login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Empleados</a>
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        
                        <!-- Header -->
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-semibold text-gray-900">Detalles del Empleado</h1>
                            <a href="{{ route('empleados.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                ← Volver a la lista
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('credenciales'))
                            <div class="mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
                                <h5 class="font-bold mb-2">¡Empleado registrado exitosamente!</h5>
                                <div class="space-y-1">
                                    <p><strong>Usuario:</strong> {{ session('credenciales')['usuario'] }}</p>
                                    <p><strong>Contraseña:</strong> {{ session('credenciales')['contrasena'] }}</p>
                                    <p><strong>Rol:</strong> {{ session('credenciales')['role'] }}</p>
                                </div>
                                <small class="text-blue-600 font-medium">Guarde estas credenciales de forma segura</small>
                            </div>
                        @endif

                        <!-- Employee Information -->
                        <div class="bg-white border border-gray-200 rounded-lg">
                            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">Información Personal</h3>
                            </div>
                            <div class="p-4">
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">ID Empleado:</span>
                                        <span class="text-sm text-gray-900">{{ $empleado->ID_Empleado }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Nombre:</span>
                                        <span class="text-sm text-gray-900">{{ $empleado->NAME_Empleado }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Apellido:</span>
                                        <span class="text-sm text-gray-900">{{ $empleado->SURNAME_Empleado }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">DNI:</span>
                                        <span class="text-sm text-gray-900">{{ $empleado->DNI_Empleado }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Email:</span>
                                        <span class="text-sm text-gray-900">{{ $empleado->EMAIL_Empleado }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Usuario:</span>
                                        <span class="text-sm text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded">{{ $empleado->USER_Empleado }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Contraseña:</span>
                                        <span class="text-sm text-gray-400">••••••••</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-700">Fecha de Registro:</span>
                                        <span class="text-sm text-gray-900">{{ $empleado->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Credentials Copy Section -->
                        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-yellow-800 mb-2">📋 Copiar Credenciales</h4>
                            <div class="flex space-x-2">
                                <button class="copiar-btn inline-flex items-center px-3 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        data-type="usuario" data-value="{{ $empleado->USER_Empleado }}">
                                    Copiar Usuario
                                </button>
                                <button class="copiar-btn inline-flex items-center px-3 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        data-type="contraseña" data-value="{{ $empleado->PSSWRD_Empleado }}">
                                    Copiar Contraseña
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('empleados.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Volver a la Lista
                            </a>
                            <a href="{{ route('empleados.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Registrar Nuevo Empleado
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para copiar al portapapeles -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('.copiar-btn');
        
        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const type = this.getAttribute('data-type');
                
                // Copiar al portapapeles
                navigator.clipboard.writeText(value).then(function() {
                    // Mostrar mensaje de éxito
                    const originalText = button.textContent;
                    button.textContent = '✓ Copiado';
                    button.style.backgroundColor = '#10B981';
                    button.style.color = 'white';
                    button.style.borderColor = '#10B981';
                    
                    setTimeout(() => {
                        button.textContent = originalText;
                        button.style.backgroundColor = '';
                        button.style.color = '';
                        button.style.borderColor = '';
                    }, 2000);
                }).catch(function() {
                    alert('Error al copiar al portapapeles');
                });
            });
        });
    });
    </script>
</body>
</html>