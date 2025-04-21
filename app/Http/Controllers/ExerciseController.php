<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        return response()->json(Exercise::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $exercise = Exercise::create($request->all());

        return response()->json($exercise, 201);
    }

    public function show($id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json(['message' => 'Exercise not found'], 404);
        }

        return response()->json($exercise);
    }

    public function update(Request $request, $id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json(['message' => 'Exercise not found'], 404);
        }

        $exercise->update($request->all());

        return response()->json($exercise);
    }

    public function destroy($id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json(['message' => 'Exercise not found'], 404);
        }

        $exercise->delete();

        return response()->json(['message' => 'Deleted'], 200);
    }
}
