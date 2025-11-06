<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ivan',
            'email' => 'Ivan@email.com',
            'password'=> bcrypt('43218765'),
            'role' => 'admin',
        ]);


        User::create([
            'name' => 'Emplea2',
            'email' => 'Emplea2@email.com',
            'password'=> bcrypt('87654321'),
            'role' => 'empleado',
        ]);


        User::create([
            'name' => 'Clien3',
            'email' => 'Clien3@email.com',
            'password'=> bcrypt('12345678'),
            'role' => 'cliente',
        ]);

        User::create([
            'name' => 'Geren3',
            'email' => 'Geren3@email.com',
            'password'=> bcrypt('43218765'),
            'role' => 'gerente',
        ]);
    }
}
