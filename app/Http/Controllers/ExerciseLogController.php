<?php

namespace App\Http\Controllers;

use App\Models\ExerciseLog;
use App\Models\WorkoutExercise;
use Illuminate\Http\Request;

class ExerciseLogController extends Controller
{
    public function index(WorkoutExercise $workoutExercise)
    {
        return response()->json($workoutExercise->exerciseLogs()->orderBy('set_number')->get());
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'workout_exercise_id' => 'required|exists:workout_exercises,id',
        'set_number' => 'required|integer|min:1',
        'reps' => 'required|integer|min:1',
        'weight' => 'required|numeric|min:0',
    ]);

    $log = ExerciseLog::create($validated);

    return response()->json($log, 201);
}


    public function update(Request $request, ExerciseLog $exerciseLog)
    {
        $data = $request->validate([
            'set_number' => 'sometimes|integer|min:1',
            'reps' => 'sometimes|integer|min:1',
            'weight' => 'sometimes|numeric|min:0',
        ]);

        $exerciseLog->update($data);

        return response()->json($exerciseLog);
    }

    // Eliminar log
    public function destroy(ExerciseLog $exerciseLog)
    {
        $exerciseLog->delete();

        return response()->json(['message' => 'Serie eliminada']);
    }
}
