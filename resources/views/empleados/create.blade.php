<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Empleado - {{ config('app.name', 'Laravel') }}</title>

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
                            <h1 class="text-2xl font-semibold text-gray-900">Registrar Nuevo Empleado</h1>
                            <a href="{{ route('empleados.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                ← Volver a la lista
                            </a>
                        </div>

                        @if($errors->any())
                            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                <h4 class="font-bold mb-2">Por favor corrige los siguientes errores:</h4>
                                <ul class="list-disc list-inside text-sm">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('empleados.store') }}">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Nombre -->
                                <div>
                                    <label for="NAME_Empleado" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <input id="NAME_Empleado" type="text" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                           name="NAME_Empleado" value="{{ old('NAME_Empleado') }}" required autofocus>
                                    @error('NAME_Empleado')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Apellido -->
                                <div>
                                    <label for="SURNAME_Empleado" class="block text-sm font-medium text-gray-700">Apellido</label>
                                    <input id="SURNAME_Empleado" type="text" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                           name="SURNAME_Empleado" value="{{ old('SURNAME_Empleado') }}" required>
                                    @error('SURNAME_Empleado')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- DNI -->
                                <div>
                                    <label for="DNI_Empleado" class="block text-sm font-medium text-gray-700">DNI</label>
                                    <input id="DNI_Empleado" type="text" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                           name="DNI_Empleado" value="{{ old('DNI_Empleado') }}" 
                                           required maxlength="8" pattern="[0-9]{8}">
                                    @error('DNI_Empleado')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    <small class="text-gray-500">8 dígitos sin puntos</small>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="EMAIL_Empleado" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input id="EMAIL_Empleado" type="email" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                           name="EMAIL_Empleado" value="{{ old('EMAIL_Empleado') }}" required>
                                    @error('EMAIL_Empleado')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Rol -->
                                <div class="md:col-span-2">
                                    <label for="role" class="block text-sm font-medium text-gray-700">Rol del Empleado</label>
                                    <select id="role" name="role" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                        <option value="">Seleccione un rol</option>
                                        <option value="empleado" {{ old('role') == 'empleado' ? 'selected' : '' }}>Empleado</option>
                                        <option value="gerente" {{ old('role') == 'gerente' ? 'selected' : '' }}>Gerente</option>
                                    </select>
                                    @error('role')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    <small class="text-gray-500">
                                        <strong>Empleado:</strong> Acceso básico al sistema | 
                                        <strong>Gerente:</strong> Puede gestionar otros empleados
                                    </small>
                                </div>
                            </div>

                            <!-- Información de credenciales automáticas -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                                <h4 class="text-sm font-medium text-blue-800 mb-2"> Información Importante</h4>
                                <p class="text-sm text-blue-700">
                                </p>
                            </div>

                            <div class="flex items-center justify-end">
                                <a href="{{ route('empleados.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-3">
                                    Cancelar
                                </a>

                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Registrar Empleado
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>