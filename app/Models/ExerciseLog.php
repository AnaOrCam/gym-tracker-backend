<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_exercise_id',
        'set_number',
        'reps',
        'weight',
    ];

    public function workoutExercise()
    {
        return $this->belongsTo(WorkoutExercise::class);
    }
}

