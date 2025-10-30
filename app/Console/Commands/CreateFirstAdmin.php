<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\CredencialEmpleado;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateFirstAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear el primer usuario administrador del sistema';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('🎯 CREACIÓN DEL PRIMER ADMINISTRADOR DEL SISTEMA');
        $this->info('=================================================');
        $this->newLine();

        // Verificar si ya existe un admin con usuario "aadminn"
        if (CredencialEmpleado::where('USER_Empleado', 'aadminn')->exists()) {
            $this->error('❌ Ya existe un administrador con el usuario "aadminn" en el sistema.');
            $this->info('💡 Si necesitas crear otro administrador, usa el panel web una vez que inicies sesión.');
            return Command::FAILURE;
        }

        // Solicitar datos personales
        $this->info('📝 DATOS PERSONALES DEL ADMINISTRADOR');
        $this->info('--------------------------------------');
        
        $nombre = $this->ask('Nombre del administrador');
        $apellido = $this->ask('Apellido del administrador');
        $dni = $this->ask('DNI (8 dígitos)');
        $email = $this->ask('Email del administrador');

        // Validar datos personales
        $validatorPersonal = Validator::make([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'dni' => $dni,
            'email' => $email,
        ], [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|digits:8',
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validatorPersonal->fails()) {
            foreach ($validatorPersonal->errors()->all() as $error) {
                $this->error("❌ $error");
            }
            return Command::FAILURE;
        }

        $this->newLine();
        $this->info('🔐 CREDENCIALES DE ACCESO');
        $this->info('-------------------------');

        // Solicitar contraseña
        $password = $this->secret('Contraseña (mínimo 8 caracteres)');
        $passwordConfirmation = $this->secret('Confirmar contraseña');

        // Validar contraseña
        $validatorPassword = Validator::make([
            'password' => $password,
            'password_confirmation' => $passwordConfirmation,
        ], [
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        if ($validatorPassword->fails()) {
            foreach ($validatorPassword->errors()->all() as $error) {
                $this->error("❌ $error");
            }
            return Command::FAILURE;
        }

        $this->newLine();
        $this->info('📊 RESUMEN DE LA INFORMACIÓN');
        $this->info('----------------------------');
        $this->line("👤 Nombre completo: {$nombre} {$apellido}");
        $this->line("🆔 DNI: {$dni}");
        $this->line("📧 Email: {$email}");
        $this->line("👨‍💼 Usuario: aadminn");
        $this->line("🔐 Contraseña: ********");
        $this->newLine();

        // Confirmar creación
        if (!$this->confirm('¿Estás seguro de que quieres crear este administrador?')) {
            $this->info('❌ Creación cancelada.');
            return Command::SUCCESS;
        }

        try {
            // Crear usuario en la tabla de autenticación
            $user = User::create([
                'name' => $nombre . ' ' . $apellido,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'admin'
            ]);

            // Crear registro en la tabla de empleados
            $empleado = CredencialEmpleado::create([
                'NAME_Empleado' => $nombre,
                'SURNAME_Empleado' => $apellido,
                'DNI_Empleado' => $dni,
                'EMAIL_Empleado' => $email,
                'USER_Empleado' => 'aadminn',
                'PSSWRD_Empleado' => $password
            ]);

            $this->newLine();
            $this->info('✅ ¡ADMINISTRADOR CREADO EXITOSAMENTE!');
            $this->info('======================================');
            $this->newLine();
            
            $this->line('📋 **CREDENCIALES DE ACCESO:**');
            $this->line('   Usuario: aadminn');
            $this->line("   Contraseña: {$password}");
            $this->line("   Email: {$email}");
            $this->newLine();
            
            $this->warn('⚠️  GUARDA ESTAS CREDENCIALES EN UN LUGAR SEGURO');
            $this->newLine();
            
            $this->info('🎯 **PRÓXIMOS PASOS:**');
            $this->line('   1. Inicia sesión en: ' . url('/login'));
            $this->line('   2. Usa las credenciales mostradas arriba');
            $this->line('   3. Desde el panel admin podrás crear más administradores');
            $this->newLine();

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Error al crear el administrador: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}