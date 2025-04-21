<?php

namespace App\Http\Controllers;

use App\Models\WorkoutExercise;
use Illuminate\Http\Request;

class WorkoutExerciseController extends Controller
{
    public function index()
    {
        return response()->json(WorkoutExercise::with(['exercise', 'entrenamiento'])->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'entrenamiento_id' => 'required|exists:entrenamientos,id',
            'exercise_id' => 'required|exists:exercises,id',
            'sets' => 'required|integer|min:1',
            'reps' => 'required|integer|min:1',
            'weight' => 'nullable|numeric|min:0',
        ]);

        $relation = WorkoutExercise::create($request->all());

        return response()->json($relation, 201);
    }

    public function show($id)
    {
        $relation = WorkoutExercise::with(['exercise', 'entrenamiento'])->find($id);

        if (!$relation) {
            return response()->json(['message' => 'Relation not found'], 404);
        }

        return response()->json($relation);
    }

    public function update(Request $request, $id)
    {
        $relation = WorkoutExercise::find($id);

        if (!$relation) {
            return response()->json(['message' => 'Relation not found'], 404);
        }

        $relation->update($request->all());

        return response()->json($relation);
    }

    public function destroy($id)
    {
        $relation = WorkoutExercise::find($id);

        if (!$relation) {
            return response()->json(['message' => 'Relation not found'], 404);
        }

        $relation->delete();

        return response()->json(['message' => 'Deleted'], 200);
    }
    // Obtener todos los ejercicios de un entrenamiento específico
    public function getExercisesByWorkout($workoutId)
    {
        $relations = WorkoutExercise::where('entrenamiento_id', $workoutId)
            ->with('exercise')
            ->get();

        if ($relations->isEmpty()) {
            return response()->json(['message' => 'No exercises found for that workout'], 404);
        }

        return response()->json($relations, 200);
    }

    // Obtener todos los entrenamientos donde aparece un ejercicio específico
    public function getWorkoutsByExercise($exerciseId)
    {
        $relations = WorkoutExercise::where('exercise_id', $exerciseId)
            ->with('entrenamiento')
            ->get();

        if ($relations->isEmpty()) {
            return response()->json(['message' => 'No workouts found for that exercise'], 404);
        }

        return response()->json($relations, 200);
    }
}
