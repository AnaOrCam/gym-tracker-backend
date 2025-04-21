<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    use HasFactory;
    protected $fillable=['name','type','train','weekday','user_id','created_at','updated_at'];
    protected $updatable=['name','type','train','weekday','user_id','created_at','updated_at'];

    public function workoutExercises()
{
    return $this->hasMany(WorkoutExercise::class, 'entrenamiento_id');
}


}
