<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tarea;


class TareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarea::create(['nombre' => 'Instalación']);
        Tarea::create(['nombre' => 'Service']);
        Tarea::create(['nombre' => 'Reconexión']);
        Tarea::create(['nombre' => 'Desconexión']);
    }
}
