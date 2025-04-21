<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'type'
    ];

    public function workoutExercises()
    {
        return $this->hasMany(WorkoutExercise::class);
    }
    

}
