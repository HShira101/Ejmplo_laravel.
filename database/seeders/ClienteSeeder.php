<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Cliente::updateOrCreate(
            ['rut' => 0],
            [
                'nombre_completo' => '-',
                'telefono' => '-',
                'correo' => '-'
            ]
        );

        \App\Models\Cliente::firstOrCreate(
            ['rut' => 11111111],
            [
                'nombre_completo' => 'Juan Pérez',
                'telefono' => '987654321',
                'correo' => 'juan@example.com'
            ]
        );

        \App\Models\Cliente::firstOrCreate(
            ['rut' => 22222222],
            [
                'nombre_completo' => 'María Gómez',
                'telefono' => '912345678',
                'correo' => 'maria@example.com'
            ]
        );

        \App\Models\Cliente::firstOrCreate(
            ['rut' => 33333333],
            [
                'nombre_completo' => 'Carlos Silva',
                'telefono' => '955555555',
                'correo' => 'carlos@example.com'
            ]
        );
    }
}
