<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        Exercise::create([
            'name' => 'Press Banca',
            'description' => 'Ejercicio de pecho',
            'muscle_group' => 'Pecho',
        ]);

        Exercise::create([
            'name' => 'Sentadilla',
            'description' => 'Ejercicio de piernas',
            'muscle_group' => 'Piernas',
        ]);

        Exercise::create([
            'name' => 'Dominadas',
            'description' => 'Ejercicio de espalda',
            'muscle_group' => 'Espalda',
        ]);
    }
}
