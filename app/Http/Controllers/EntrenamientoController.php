<?php

namespace App\Http\Controllers;

use App\Models\Entrenamiento;
use Illuminate\Http\Request;

class EntrenamientoController extends Controller
{
    public function index(){
        $workouts =Entrenamiento::all();
        return response()->json($workouts,200);
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
             'type' => 'required|string|max:255',
             'train' => 'required|string|max:255',
             'weekday' => 'string|max:255',
             'user_id' => 'required',
         ]);
         $workout=Entrenamiento::create([
            'name'=>$request->name,
            'type'=>$request->type,
            'train'=>$request->train,
            'weekday'=>$request->weekday,
            'user_id'=>$request->user_id
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
}
