<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Date\Jalali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class QuizController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string",
            'start' => 'nullable|string',
            'end' => 'nullable|string',
            'time' => 'required|string',
            'score' => 'required|numeric',
            'scoreN' => 'nullable|numeric',
            'type' => 'required|string',
            'questions.*.question' => 'required|string',
            'questions.*.type' => 'required',
            'questions.*.option' => 'nullable|array',
            'questions.*.answer' => 'nullable|string',
            'questions.*.score' => 'nullable|numeric',
        ]);
        $user = auth();
        $quiz = Quiz::create([
            'name' => $request->name,
            'user_id' => $user->id(),
            'start' => !!$request->start ? (new Jalali($request->start))->toGregorian()->format('Y-m-d H:i:s') : null,
            'end' => !!$request->end ? (new Jalali($request->end))->toGregorian()->format('Y-m-d H:i:s') : null,
            'time' => $request->time,
            'score' => $request->score,
            'scoreN' => $request->scoreN,
            'type' => $request->type,
            'uuid' => (string)Str::uuid(),
        ]);

        foreach ($request->questions as $question) {
            QuestionController::store($question, $quiz->id);
        }

        return Redirect::route('teacher.information.quiz', ['quiz' => $quiz->uuid]);
    }

    public function edit(Quiz $quiz, Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => "required|string",
            'start' => 'nullable|string',
            'end' => 'nullable|string',
            'time' => 'required|string',
            'score' => 'required|numeric',
            'scoreN' => 'nullable|numeric',
            'type' => 'required|string',
            'questions.*.question' => 'required|string',
            'questions.*.type' => 'required',
            'questions.*.option' => 'nullable',
            'questions.*.answer' => 'nullable|string',
            'questions.*.score' => 'nullable|numeric',
            'deleted' => 'nullable|array'
        ]);
        $quiz->update([
            'name' => $request->name,
            'start' => !!$request->start ? (new Jalali($request->start))->toGregorian()->format('Y-m-d H:i:s') : null,
            'end' => !!$request->end ? (new Jalali($request->end))->toGregorian()->format('Y-m-d H:i:s') : null,
            'time' => $request->time,
            'score' => $request->score,
            'scoreN' => $request->scoreN,
            'type' => $request->type,
        ]);
        foreach ($request->questions as $key => $question) {
            if (is_int($key)) {
                QuestionController::edit($question, $key);
            } else {
                QuestionController::store($question, $request->id);
            }
        }
        foreach ($request->deleted as $deleted) {
            QuestionController::deleted($deleted);
        }
        return Redirect::route('teacher.information.quiz', ['quiz' => $quiz->uuid]);
    }
}
