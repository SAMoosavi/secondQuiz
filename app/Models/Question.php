<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int|string $questionId)
 */
class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'type',
        'option',
        'answer',
        'quiz_id',
        'score',
    ];

    public function Quiz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
