<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Habitacion;

class HabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usamos hotel_id (1, 2, 3) imaginando que luego crearemos los hoteles con esos IDs
        Habitacion::create([
            'numero' => '101',
            'hotel_id' => 1,
            'tipo' => 'Sencilla',
            'categoria' => 'Estándar',
        ]);
        
        Habitacion::create([
            'numero' => '205',
            'hotel_id' => 2,
            'tipo' => 'Doble',
            'categoria' => 'Premium',
        ]);
        
        Habitacion::create([
            'numero' => 'Suite 3A',
            'hotel_id' => 3,
            'tipo' => 'Suite panorámica',
            'categoria' => 'VIP',
        ]);
    }
}
