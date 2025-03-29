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
     public function update(Request $request,$id){
        $workout = Entrenamiento::findOrFail($id);
         if (!$workout) {
            return response()->json(['message' => 'Workout not found'], 404);
        }
         $workout->update($request->all());
         return response()->json($workout);
     }
     public function destroy($id){
        $workout=Entrenamiento::find($id);
        if (!$workout) {
            return response()->json(['message' => 'Workout not found'], 404);
        }
        $workout->delete();
        return response()->json(['message'=>'Deleted'],200);
     }
     public function getWorkoutsByUser($idUser){
        $workouts=Entrenamiento::where('user_id',$idUser)->get();
        if (!$workouts) {
            return response()->json(['message' => 'Workouts not found for that user'], 404);
        }
        return response()->json($workouts,200);
     }
     public function getWorkoutsByUserAndType($idUser,$type){
        $workouts=Entrenamiento::where('type',$type)->where('user_id',$idUser)->get();
        if ($workouts->isEmpty()) { // Corregido
            return response()->json(['message' => 'Workouts not found for that user and type'], 404);
        }
        return response()->json($workouts,200);
     }
     public function getWorkoutsByUserAndTrain($idUser,$train){
        $workouts=Entrenamiento::where('train',$train)->where('user_id',$idUser)->get();
        if ($workouts->isEmpty()) { // Corregido
            return response()->json(['message' => 'Workouts not found for that user and train'], 404);
        }
        return response()->json($workouts,200);
     }


}
