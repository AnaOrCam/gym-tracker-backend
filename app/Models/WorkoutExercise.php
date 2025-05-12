<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'entrenamiento_id',
        'exercise_id',
        'sets',
        'reps',
        'weight'
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function entrenamiento()
    {
        return $this->belongsTo(Entrenamiento::class);
    }
    public function exerciseLogs()
    {
        return $this->hasMany(ExerciseLog::class);
    }
}
