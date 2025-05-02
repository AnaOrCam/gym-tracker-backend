<?php

namespace App\Http\Controllers;

use App\Models\Entrenamiento;
use App\Models\Exercise;
use App\Models\WorkoutExercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntrenamientoController extends Controller
{
    public function index()
    {
        $workouts = Entrenamiento::all();
        return response()->json($workouts, 200);
    }
    public function storeWithExercises(Request $request)
    {
        $validated = $request->validate([
            'workout.name' => 'required|string',
            'workout.type' => 'required|string',
            'workout.train' => 'required|string',
            'workout.weekday' => 'required|string',
            'workout.user_id' => 'required|exists:users,id',
            'exercises' => 'required|array|min:1',
            'exercises.*.name' => 'required|string',
            'exercises.*.description' => 'nullable|string',
            'exercises.*.sets' => 'required|integer',
            'exercises.*.reps' => 'required|integer',
            'exercises.*.weight' => 'required|numeric',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Crear el workout desde $validated['workout']
            $workout = Entrenamiento::create($validated['workout']);
        
            // Crear ejercicios
            foreach ($validated['exercises'] as $exerciseData) {
                $exercise = Exercise::create([
                    'name' => $exerciseData['name'],
                    'description' => $exerciseData['description'],
                ]);
        
                WorkoutExercise::create([
                    'entrenamiento_id' => $workout->id,
                    'exercise_id' => $exercise->id,
                    'sets' => $exerciseData['sets'],
                    'reps' => $exerciseData['reps'],
                    'weight' => $exerciseData['weight'],
                ]);
            }
        
            DB::commit();
        
            return response()->json(['message' => 'Entrenamiento y ejercicios creados correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al guardar los datos', 'message' => $e->getMessage()], 500);
        }
        
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'train' => 'required|string|max:255',
            'weekday' => 'string|max:255',
            'user_id' => 'required',
        ]);
        $workout = Entrenamiento::create([
            'name' => $request->name,
            'type' => $request->type,
            'train' => $request->train,
            'weekday' => $request->weekday,
            'user_id' => $request->user_id
        ]);
        return response()->json($workout, 201);
    }
    public function show($id)
    {
        $workout = Entrenamiento::find($id);

        if (!$workout) {
            return response()->json(['message' => 'workout not found'], 404);
        }

        return response()->json($workout);
    }
    public function update(Request $request, $id)
    {
        $workout = Entrenamiento::findOrFail($id);
        if (!$workout) {
            return response()->json(['message' => 'Workout not found'], 404);
        }
        $workout->update($request->all());
        return response()->json($workout);
    }
    public function destroy($id)
    {
        $workout = Entrenamiento::find($id);
        if (!$workout) {
            return response()->json(['message' => 'Workout not found'], 404);
        }
        $workout->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
    public function getWorkoutsByUser($idUser)
    {
        $workouts = Entrenamiento::where('user_id', $idUser)->get();
        if (!$workouts) {
            return response()->json(['message' => 'Workouts not found for that user'], 404);
        }
        return response()->json($workouts, 200);
    }
    public function getWorkoutsByUserAndType($idUser, $type)
    {
        $workouts = Entrenamiento::where('type', $type)->where('user_id', $idUser)->get();
        if ($workouts->isEmpty()) { // Corregido
            return response()->json(['message' => 'Workouts not found for that user and type'], 404);
        }
        return response()->json($workouts, 200);
    }
    public function getWorkoutsByUserAndTrain($idUser, $train)
    {
        $workouts = Entrenamiento::where('train', $train)->where('user_id', $idUser)->get();
        if ($workouts->isEmpty()) { // Corregido
            return response()->json(['message' => 'Workouts not found for that user and train'], 404);
        }
        return response()->json($workouts, 200);
    }
}
