<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $string1, $id)
 * @method static create(array $array)
 */
class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'type',
        'user_id',
        'question_id',
        'score',
    ];
}
