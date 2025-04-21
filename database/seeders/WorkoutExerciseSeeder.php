<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkoutExercise;
use App\Models\Exercise;
use App\Models\Entrenamiento;

class WorkoutExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $entrenamiento = Entrenamiento::first(); // Asumimos que ya existe un entrenamiento en la base de datos
        $exercise1 = Exercise::where('name', 'Press Banca')->first();
        $exercise2 = Exercise::where('name', 'Sentadilla')->first();

        if ($entrenamiento && $exercise1 && $exercise2) {
            WorkoutExercise::create([
                'entrenamiento_id' => $entrenamiento->id,
                'exercise_id' => $exercise1->id,
                'sets' => 4,
                'reps' => 10,
                'weight' => 80,
            ]);

            WorkoutExercise::create([
                'entrenamiento_id' => $entrenamiento->id,
                'exercise_id' => $exercise2->id,
                'sets' => 4,
                'reps' => 12,
                'weight' => 100,
            ]);
        }
    }
}

