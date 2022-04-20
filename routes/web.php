<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentQuizController;
use App\Models\Quiz;
use App\Models\StudentQuiz;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard/Dashboard');
})->name('dashboard');
Route::get('/create-quiz', function () {
    return Inertia::render(
        'Dashboard/Dashboard',
        ['showQuiz' => true, 'showIndex' => -1, 'component' => 'create-quiz']
    );
})->name('create.quiz');
Route::post('/create-quiz', [QuizController::class, 'store'])->name('store.quiz');
Route::get('/teacher/edit/{quiz:uuid}', function (Quiz $quiz) {
    $quiz->start = !!$quiz->start ? (new \Date\Date($quiz->start))->toJalali()->format('Y-m-d H:i:s') : null;
    $quiz->end = !!$quiz->end ? (new \Date\Date($quiz->end))->toJalali()->format('Y-m-d H:i:s') : null;

    return Inertia::render('Dashboard/Dashboard', [
        'showQuiz' => true,
        'showIndex' => $quiz->uuid,
        'component' => 'edit-quiz',
        'myProps' => [
            'quiz' => $quiz,
            'questions' => $quiz->Questions,
        ],
    ]);
})->name('teacher.edit.quiz');
Route::put('/teacher/edit/{quiz:uuid}', [QuizController::class, 'edit'])->name('edit.quiz');
Route::get('/teacher/information/{quiz:uuid}', function (Quiz $quiz) {
    //    dd($quiz, $quiz->Teacher, $quiz->Questions);
    return Inertia::render('Dashboard/Dashboard', [
        'showQuiz' => true,
        'showIndex' => $quiz->uuid,
        'component' => 'information-quiz',
    ]);
})->name('teacher.information.quiz');
Route::get('/student/{quiz:uuid}', [StudentQuizController::class, 'index'])->name('student.quiz');
Route::post('/student/answered/descriptive', [AnswerController::class, 'storeDescriptive'])->name('student.answered.descriptive');
Route::post('/student/answered/test', [AnswerController::class, 'storeTest'])->name('student.answered.test');
/***************************API**************************/
Route::get('/teacher/quiz', function () {
    $quizzes = User::find(auth()->id())->TeacherQuizzes()->select(['name', 'uuid'])->latest()->get();

    return response(['quizzes' => $quizzes], 200);
})->name('get.teacher.quizzes');

Route::get('students/{quiz:uuid}', function (Quiz $quiz) {
    $students =  StudentQuiz::where('quiz_id', '=', $quiz->id)->get()->map(function ($item) {
        return $item->Student;
    });

    return response(['students' => $students], 200);
})->name('get.students');
