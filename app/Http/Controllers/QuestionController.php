<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionController extends Controller
{
    static public function store($question, $quizId)
    {
        Question::create([
            'question' => $question['question'],
            'type' => $question['type'],
            'option' => json_encode($question['option']),
            'answer' => $question['answer'],
            'score' => (float)$question['score'],
            'quiz_id' => $quizId,
        ]);
    }

    static public function edit($question, $key)
    {
        Question::find($key)->update([
            'question' => $question['question'],
            'type' => $question['type'],
            'option' => $question['option'],
            'answer' => $question['answer'],
            'score' => (float)$question['score'],
        ]);

    }

    static public function deleted($deleted)
    {
        Question::find($deleted)->delete();
    }
}
