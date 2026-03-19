<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        Hotel::firstOrCreate(
            ['nombre' => 'Hotel Paraíso'],
            [
                'telefono' => '+123 456 7890',
                'direccion' => 'Av. de la Playa 123',
                'categoria' => '4 Estrellas',
            ]
        );
        
        Hotel::firstOrCreate(
            ['nombre' => 'Hotel Costa Azul'],
            [
                'telefono' => '+198 765 4321',
                'direccion' => 'Calle Marítima 45',
                'categoria' => '3 Estrellas',
            ]
        );
        
        Hotel::firstOrCreate(
            ['nombre' => 'Hotel Montaña'],
            [
                'telefono' => '+112 233 4455',
                'direccion' => 'Paseo los Alpes 90',
                'categoria' => '5 Estrellas',
            ]
        );
    }
}
