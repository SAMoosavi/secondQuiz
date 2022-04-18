<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $string1, int|string|null $userId)
 * @method static create(array $array)
 * @property mixed $created_at
 */
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
