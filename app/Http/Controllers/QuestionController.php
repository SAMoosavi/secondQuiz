<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    static public function store($question,$quizId){
        Question::create([
            'question' => $question['question'],
            'type' => $question['type'],
            'option' =>  json_encode($question['option']),
            'answer' => $question['answer'],
            'score' => (float)$question['score'],
            'quiz_id' => $quizId,
        ]);
    }
}
