<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Agencia::updateOrCreate(
            ['id' => 0],
            [
                'nombre' => '-',
                'telefono' => '-'
            ]
        );

        \App\Models\Agencia::firstOrCreate(
            ['nombre' => 'Viajes del Sur'],
            ['telefono' => '800111222']
        );

        \App\Models\Agencia::firstOrCreate(
            ['nombre' => 'Turismo Global'],
            ['telefono' => '800333444']
        );

        \App\Models\Agencia::firstOrCreate(
            ['nombre' => 'Aventuras Express'],
            ['telefono' => '800555666']
        );
    }
}
