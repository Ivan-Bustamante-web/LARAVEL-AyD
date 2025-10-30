<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CredencialEmpleado extends Model
{
    use HasFactory;
    
    protected $table = 'credenciales_empleados';
    
    protected $primaryKey = 'ID_Empleado';

    protected $fillable = [
        'NAME_Empleado',
        'SURNAME_Empleado', 
        'DNI_Empleado',
        'EMAIL_Empleado',
        'USER_Empleado',
        'PSSWRD_Empleado'
    ];

    protected $hidden = [
        'PSSWRD_Empleado'
    ];
}
