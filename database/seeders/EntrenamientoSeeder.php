<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entrenamiento;

class EntrenamientoSeeder extends Seeder
{
    public function run(): void
    {
        Entrenamiento::create([
            'name' => 'Entrenamiento de Pecho',
            'type' => 'fuerza',
            'train' => 'hipertrofia',
            'weekday' => 'lunes',
            'user_id' => 1,  // Asegúrate de que el usuario 1 existe
        ]);

        Entrenamiento::create([
            'name' => 'Entrenamiento de Piernas',
            'type' => 'fuerza',
            'train' => 'resistencia',
            'weekday' => 'miércoles',
            'user_id' => 1,
        ]);

        Entrenamiento::create([
            'name' => 'Entrenamiento de Espalda',
            'type' => 'fuerza',
            'train' => 'hipertrofia',
            'weekday' => 'viernes',
            'user_id' => 1,
        ]);
    }
}
