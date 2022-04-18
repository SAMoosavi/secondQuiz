<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $Questions
 * @property mixed $id
 * @property mixed $uuid
 * @property mixed $user_id
 * @property mixed $start
 * @property mixed $end
 * @property mixed $type
 * @property mixed $time
 */
class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start',
        'end',
        'time',
        'user_id',
        'uuid',
        'score',
        'scoreN',
        'type',
    ];

    public function Teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Questions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Question::class);
    }
}
