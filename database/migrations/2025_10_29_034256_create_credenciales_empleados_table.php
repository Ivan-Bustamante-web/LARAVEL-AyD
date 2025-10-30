<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credenciales_empleados', function (Blueprint $table) {
            $table->id('ID_Empleado');
            $table->string('NAME_Empleado');
            $table->string('SURNAME_Empleado');
            $table->string('DNI_Empleado', 8)->unique();
            $table->string('EMAIL_Empleado')->unique();
            $table->string('USER_Empleado')->unique();
            $table->string('PSSWRD_Empleado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credenciales_empleados');
    }
};
