<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\StudentQuiz;
use Date\Date;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use JetBrains\PhpStorm\NoReturn;

class StudentQuizController extends Controller
{
    public function index(Quiz $quiz)
    {
        $userId = auth()->id();
        if ($quiz->user_id != $userId) {
            $now = strtotime(date("Y-m-d H:i:s"));
            $studentQuiz = StudentQuiz::where('user_id', '=', $userId)->where('quiz_id', '=', $quiz->id)->first();
            if ($quiz->start != null && $now < strtotime($quiz->start)) {
                return $this->noStart($quiz);
            }
            elseif ($quiz->end != null && $now > strtotime($quiz->end)) {
                return $this->result($quiz);
            }
            elseif ($studentQuiz) {
                if ($studentQuiz->end) {
                    return $this->result($quiz);
                }
                else {
                    return $this->show($quiz, $studentQuiz);
                }
            }
            else {
                $studentQuiz = StudentQuiz::create([
                    'end' => null,
                    'quiz_id' => $quiz->id,
                    'user_id' => $userId,
                ]);

                return $this->show($quiz, $studentQuiz);
            }
        }
        else {
            return Redirect::route('teacher.information.quiz', ['quiz' => $quiz->uuid]);
        }
    }

    /**
     * @throws /Date/Date
     */
    private function show(Quiz $quiz, StudentQuiz $studentQuiz)
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
        }
        elseif ($quiz->type == 'test') {
            return Inertia::render('Student/AnswerQuiz/Test/Index', [
                'quiz' => $quiz,
                'questions' => $questions,
                'start' => strtotime($studentQuiz->created_at) ? strtotime($studentQuiz->created_at) : $now,
                'now' => $now,
            ]);
        }
        else {
            return null;
        }
    }

    private function noStart(Quiz $quiz)
    {
        $now = strtotime(date("Y-m-d H:i:s"));
        $time = strtotime($quiz->start) - $now;
        $seconds = $time % 60;
        $time = floor($time / 60);
        $minutes = $time % 60;
        $time = floor($time / 60);
        $hours = $time;
        $time = $hours . ":" . $minutes . ":" . $seconds;

        return Inertia::render(
            'Student/NoStart/index',
            ['uuid' => $quiz->uuid, 'now' => $now, 'start' => $now, 'time' => $time]
        );
    }

    #[NoReturn] public function result(Quiz $quiz)
    {
        dd('Result');
        $userId = auth()->id();
        $studentQuiz = StudentQuiz::where('user_id', '=', $userId)->where('quiz_id', '=', $quiz->id)->first();
        $questions = $quiz->Questions->map(function ($question) use ($userId) {
            $ans = Answer::where('question_id', '=', $question->id)->where('user_id', '=', $userId)->first();

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
    }

    static function setEndTime(Quiz $quiz)
    {
        StudentQuiz::where('user_id', '=', auth()->id())->where('quiz_id', '=', $quiz->id)->first()->update([
            'end' => date("Y-m-d H:i:s"),
        ]);
    }

    static function setScore(Quiz $quiz, $score)
    {
        StudentQuiz::where('user_id', '=', auth()->id())->where('quiz_id', '=', $quiz->id)->first()->update([
            'score' => $score,
        ]);
    }
}
