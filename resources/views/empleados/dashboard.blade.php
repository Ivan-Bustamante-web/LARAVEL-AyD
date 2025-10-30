<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Portal Empleados</title>

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
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            
            <!-- Header -->
            <div class="text-center mb-6">
                <div class="flex justify-center mb-4">
                    <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard de Empleado</h1>
                <p class="text-sm text-gray-600 mt-2">Bienvenido al sistema interno</p>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <!-- User Info -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">{{ Auth::user()->name }}</h3>
                        <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                        <span class="inline-block mt-1 px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                    <form method="POST" action="{{ route('empleados.logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-gray-900">Activo</div>
                    <div class="text-sm text-gray-600">Estado</div>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-gray-900">0</div>
                    <div class="text-sm text-gray-600">Tareas Pendientes</div>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-gray-900">0</div>
                    <div class="text-sm text-gray-600">Notificaciones</div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="bg-white border border-gray-200 rounded-lg mb-6">
                <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Información Personal</h3>
                </div>
                <div class="p-4">
                    @php
                        $empleado = App\Models\CredencialEmpleado::where('EMAIL_Empleado', Auth::user()->email)->first();
                    @endphp
                    
                    @if($empleado)
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-700">Nombre completo:</span>
                            <span class="text-sm text-gray-900">{{ $empleado->NAME_Empleado }} {{ $empleado->SURNAME_Empleado }}</span>
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
                    </div>
                    @else
                    <p class="text-sm text-gray-500 text-center">Información no disponible</p>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white border border-gray-200 rounded-lg">
                <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Acciones Rápidas</h3>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 gap-3">
                        <button class="w-full text-left px-4 py-3 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Ver Mi Horario</span>
                            </div>
                        </button>
                        
                        <button class="w-full text-left px-4 py-3 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Solicitar Permisos</span>
                            </div>
                        </button>
                        
                        <button class="w-full text-left px-4 py-3 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Ver Comunicados</span>
                            </div>
                        </button>
                        
                        <button class="w-full text-left px-4 py-3 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Descargar Recibos</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500">
                    Sistema de Gestión de Empleados • {{ date('Y') }}
                </p>
            </div>
        </div>
    </div>
</body>
</html>