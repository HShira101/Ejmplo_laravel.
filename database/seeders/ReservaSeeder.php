<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reserva;

class ReservaSeeder extends Seeder
{
    public function run(): void
    {
        Reserva::firstOrCreate(
            ['codigo' => 1],
            [
                'id_habitacion' => 1,
                'rut_cliente' => 0,
                'fecha_ini' => '2026-03-20',
                'fecha_termino' => '2026-03-25',
                'id_agencia' => 3,
                'check_in' => false,
                'observaciones' => [['tipo' => 'observacion', 'detalle' => 'Cama extra', 'estado' => 'Pendiente']]
            ]
        );

        Reserva::firstOrCreate(
            ['codigo' => 2],
            [
                'id_habitacion' => 2,
                'rut_cliente' => 11111111,
                'fecha_ini' => '2026-03-22',
                'fecha_termino' => '2026-03-28',
                'id_agencia' => 1,
                'check_in' => false,
                'observaciones' => [['tipo' => 'urgente', 'detalle' => 'Fuga de agua', 'estado' => 'pendiente']]
            ]
        );
        
        Reserva::firstOrCreate(
            ['codigo' => 3],
            [
                'id_habitacion' => 3,
                'rut_cliente' => 22222222,
                'fecha_ini' => '2026-04-01',
                'fecha_termino' => '2026-04-05',
                'id_agencia' => 2,
                'check_in' => false,
                'observaciones' => []
            ]
        );

        Reserva::firstOrCreate(
            ['codigo' => 4],
            [
                'id_habitacion' => 3,
                'rut_cliente' => 22222222,
                'fecha_ini' => '2026-04-05',
                'fecha_termino' => '2026-04-07',
                'id_agencia' => 0,
                'check_in' => false,
                'observaciones' => []
            ]
        );
    }
}
