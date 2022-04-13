<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'userId' => 'required|numeric',
            'answer' => 'required|array',
            'answer.*' => 'required|string',
        ]);
        foreach ($request->answer as $key => $answer) {
            $this->setAnswer($key, $answer, $request->userId);
        }

        return Redirect::route('dashboard');
    }

    private function setAnswer($key, $answer, $userId)
    {
        Answer::create([
            'user_id' => $userId,
            'question_id' => $key,
            'answer' => $answer,
            'type' => Question::find($key)->type,
        ]);
    }
}
