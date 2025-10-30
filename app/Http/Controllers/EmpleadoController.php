<?php

namespace App\Http\Controllers;

use App\Models\CredencialEmpleado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $query = CredencialEmpleado::query();
        
        // Filtros
        if ($request->has('nombre') && $request->nombre != '') {
            $query->where('NAME_Empleado', 'like', '%' . $request->nombre . '%');
        }
        
        if ($request->has('apellido') && $request->apellido != '') {
            $query->where('SURNAME_Empleado', 'like', '%' . $request->apellido . '%');
        }
        
        if ($request->has('dni') && $request->dni != '') {
            $query->where('DNI_Empleado', 'like', '%' . $request->dni . '%');
        }
        
        $empleados = $query->get();
        
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'NAME_Empleado' => 'required|string|max:255',
            'SURNAME_Empleado' => 'required|string|max:255',
            'DNI_Empleado' => 'required|digits:8|unique:credenciales_empleados,DNI_Empleado',
            'EMAIL_Empleado' => 'required|email|unique:credenciales_empleados,EMAIL_Empleado',
            'role' => 'required|in:empleado,gerente'
        ]);

        // Generar credenciales automáticas
    $usuario = strtolower($validated['NAME_Empleado']) . '.' . strtolower($validated['SURNAME_Empleado']);
    $contrasena = $validated['DNI_Empleado'];

        // Crear en tabla de empleados
        $empleado = CredencialEmpleado::create([
            'NAME_Empleado' => $validated['NAME_Empleado'],
            'SURNAME_Empleado' => $validated['SURNAME_Empleado'],
            'DNI_Empleado' => $validated['DNI_Empleado'],
            'EMAIL_Empleado' => $validated['EMAIL_Empleado'],
            'USER_Empleado' => $usuario,
            'PSSWRD_Empleado' => $contrasena
        ]);

        // Crear usuario en el sistema de autenticación
        User::create([
            'name' => $validated['NAME_Empleado'] . ' ' . $validated['SURNAME_Empleado'],
            'email' => $validated['EMAIL_Empleado'],
            'password' => Hash::make($contrasena),
            'role' => $validated['role']
        ]);

        return redirect()->route('empleados.show', $empleado->ID_Empleado)
        ->with('success', 'Empleado registrado exitosamente.')
        ->with('credenciales', [
            'usuario' => $usuario,
            'contrasena' => $contrasena,
            'role' => $validated['role']
                         ]);
    }

    public function show($id)
    {
        $empleado = CredencialEmpleado::findOrFail($id);
        return view('empleados.show', compact('empleado'));
    }

    public function copiarCredencial($tipo, $id)
    {
        $empleado = CredencialEmpleado::findOrFail($id);
        
        $valor = $tipo === 'usuario' ? $empleado->USER_Empleado : $empleado->PSSWRD_Empleado;
        
        return response()->json(['valor' => $valor]);
    }


    //Procesar el login de empleados
   public function login(Request $request)
   {
       $request->validate([
           'usuario' => 'required|string',
           'password' => 'required|string',
       ]);

       // Buscar el usuario en la tabla de empleados
       $empleado = CredencialEmpleado::where('USER_Empleado', $request->usuario)->first();

       // Verificar credenciales
       if (!$empleado || $empleado->PSSWRD_Empleado !== $request->password) {
           throw ValidationException::withMessages([
               'usuario' => ['Las credenciales proporcionadas son incorrectas.'],
           ]);
       }

       // Buscar el usuario en el sistema de autenticación
       $user = User::where('email', $empleado->EMAIL_Empleado)->first();

       if ($user) {
           // Iniciar sesión con el usuario del sistema
           Auth::login($user);
           
           return redirect()->route('empleados.dashboard')
                            ->with('success', '¡Bienvenido ' . $empleado->NAME_Empleado . '!');
       }

       throw ValidationException::withMessages([
           'usuario' => ['Error en el sistema de autenticación.'],
       ]);
   }


    //Cerrar sesión de empleados
   public function logout(Request $request)
   {
       Auth::logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();

       return redirect()->route('empleados.login')
                        ->with('success', 'Sesión cerrada exitosamente.');
   }

}