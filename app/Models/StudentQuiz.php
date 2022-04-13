<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'end',
        'score',
        'user_id',
        'quiz_id',
    ];
}
