<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AnswerController extends Controller
{
    public function storeDescriptive(Request $request)
    {
        $request->validate([
            'userId' => 'required|numeric',
            'answer' => 'required|array',
            'answer.*' => 'required|string',
        ]);
        $questionId = null;
        foreach ($request->answer as $key => $answer) {
            $this->setAnswer($key, $answer, $request->userId);
            $questionId = $key;
        }
        StudentQuizController::setEndTime(Question::find($questionId)->Quiz);
        return Redirect::route('dashboard');
    }

    public function storeTest(Request $request)
    {
        $request->validate([
            'userId' => 'required|numeric',
            'answer' => 'required|array',
            'answer.*' => 'required|string',
        ]);
        $questionId = null;
        $correct = 0;
        $incorrect = 0;
        foreach ($request->answer as $key => $answer) {
            $this->setAnswer($key, $answer, $request->userId);
            $questionId = $key;
            $question = Question::find($questionId);
            if ($question->answer == $answer) {
                $correct++;
            }
            else {
                $incorrect++;
            }
        }
        $quiz = Question::find($questionId)->Quiz;
        $numberQuestions = $quiz->Questions->count();
        $score = $quiz->scoreN ? ($quiz->score / $numberQuestions) * ($correct - $incorrect / $quiz->scoreN) : ($quiz->score / $numberQuestions) * ($correct);
        StudentQuizController::setScore($quiz, $score);
        StudentQuizController::setEndTime($quiz);
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
