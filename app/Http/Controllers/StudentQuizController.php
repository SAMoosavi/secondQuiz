<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\StudentQuiz;
use Date\Date;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class StudentQuizController extends Controller
{
    public function index(Quiz $quiz)
    {
        $userId = auth()->id();
        if ($quiz->user_id != $userId) {
            $now = strtotime(date("Y-m-d H:i:s"));
            if ( ! !$quiz->start && $now < strtotime($quiz->start)) {
                $time = strtotime($quiz->start) - $now;
                $seconds = $time % 60;
                $time = floor($time / 60);
                $minutes = $time % 60;
                $time = floor($time / 60);
                $hours = $time;
                $time = $hours.":".$minutes.":".$seconds;

                return Inertia::render(
                    'Student/NoStart/index',
                    ['uuid' => $quiz->uuid, 'now' => $now, 'start' => $now, 'time' => $time]
                );
            } else if ( ! !$quiz->end && $now > strtotime($quiz->end)) {
                #Result
                $studentQuiz = StudentQuiz::where('user_id', '=', $userId)->where('quiz_id', '=', $quiz->id)->first();
                $questions = $quiz->questions->map(function ($question) {
                    $ans = Answer::where('question_id', '=', $question->id)->where('user_id', '=', auth()->id())->first(
                    );

                    return [
                        'id' => $question->id,
                        'questions' => $question->questions,
                        'type' => $question->type,
                        'option' => json_decode($question->option),
                        'answer' => $question->answer,
                        'point' => $question->point,
                        'quiz_id' => $question->quiz_id,
                        'answerStudent' => $ans->answer,
                        'pointStudent' => $ans->point,
                    ];
                });

                return Inertia::render(
                    'Student/ResultQuiz',
                    ['quiz' => $quiz, 'questions' => $questions, 'studentQuiz' => $studentQuiz]
                );
            } else if ( !StudentQuiz::where('user_id', '=', $userId)->where('quiz_id', '=', $quiz->id)->get()->isEmpty(
            )) {
                $studentQuiz = StudentQuiz::where('user_id', '=', $userId)->where('quiz_id', '=', $quiz->id)->first();
                if ( !$studentQuiz->end) {
                    return $this->show($quiz, $studentQuiz);
                } else {
                    $questions = $quiz->Questions->map(function ($question) use ($userId) {
                        $ans = Answer::where('question_id', '=', $question->id)->where('user_id', '=', $userId)->first(
                        );

                        return [
                            'id' => $question->id,
                            'questions' => $question->questions,
                            'type' => $question->type,
                            'option' => json_decode($question->option),
                            'answer' => $question->answer,
                            'point' => $question->point,
                            'quiz_id' => $question->quiz_id,
                            'answerStudent' => $ans->answer,
                            'pointStudent' => $ans->point,
                        ];
                    });

                    return Inertia::render(
                        'Student/ResultQuiz',
//                        ['quiz' => $quiz, 'questions' => $questions, 'studentQuiz' => $studentQuiz]
                    );
                }
            } else {
                $studentQuiz = StudentQuiz::create([
                    'start' => date("Y-m-d H:i:s"),
                    'end' => null,
                    'quiz_id' => $quiz->id,
                    'user_id' => $userId,
                ]);

                return $this->show($quiz, $studentQuiz);
            }
        } else {
            return Redirect::route('teacher.information.quiz', ['quiz' => $quiz->uuid]);
        }
    }

    /**
     * @throws /Date/Date
     */
    public function show($quiz, $studentQuiz)
    {
        $quiz->start = $quiz->start ? (new Date($quiz->start))->toJalali()->format('Y-m-d H:i:s') : null;
        $quiz->end = $quiz->end ? (new Date($quiz->end))->toJalali()->format('Y-m-d H:i:s') : null;
        $questions = $quiz->Questions()->select(['id', 'question', 'type', 'option', 'score'])->get();
        $now = strtotime(date("Y-m-d H:i:s"));
        if ($quiz->type == 'descriptive') {
            return Inertia::render('Student/AnswerQuiz/Descriptive/Index', [
                'quiz' => $quiz,
                'questions' => $questions,
                'start' => strtotime($studentQuiz->created_at) ? strtotime($studentQuiz->created_at) : $now,
                'now' => $now,
            ]);
        } else if ($quiz->type == 'test') {
            return Inertia::render('Student/AnswerQuiz/Test/Index', [
                'quiz' => $quiz,
                'questions' => $questions,
            ]);
        } else {
            return null;
        }
    }
}
