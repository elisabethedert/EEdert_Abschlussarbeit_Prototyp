<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionResults;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($lecture)
    {
        $questions = Question::where('lecture', $lecture)->inRandomOrder()->get();

        $questions->transform(function ($question) {
            $answers = Answer::where('question_id', $question->id)->get()->shuffle();
            $question->answers = $answers->map(function ($answer) {
                unset($answer->correct_answer);
                return $answer;
            });
            unset($question->blanks);

            return $question;
        });

        //View to see by the User
        return Inertia::render('Lecture', [
            'questions' => $questions
        ]);
    }

    public function results(Request $request)
    {
        $numCorrectAnswered = QuestionResults::where('user_id', $request->user()->id)
            ->where('session', $request->route('session')) //sessionnummer
            ->sum('question_correct_count');

        $numIncorrectAnswered = QuestionResults::where('user_id', $request->user()->id)
            ->where('session', $request->route('session')) //sessionnummer
            ->sum('question_incorrect_count');

        $firstLectureResult = QuestionResults::where('user_id', $request->user()->id)
            ->where('session', $request->route('session')) //sessionnummer
            ->first();

        if (!$firstLectureResult) {
            abort(404);
        }

        $currentUnit = $firstLectureResult->unit;
        $currentLecture = $firstLectureResult->lecture;
        
        $highestLectureInUnit = Question::where('unit', $currentUnit)
        ->max('lecture');
        
        if ($currentLecture === $highestLectureInUnit) {
            $isHighestLectureInUnit = true;
        } else {
            $isHighestLectureInUnit = false;
        }

        $bestScore = QuestionResults::where('user_id', $request->user()->id)
            ->where('lecture', $currentLecture)
            ->groupBy('session')
            ->select(DB::raw('SUM(question_correct_count) as total_correct_answers'))
            ->orderBy('total_correct_answers', 'desc')
            ->first();

        $totalCorrectAnswers = $bestScore->total_correct_answers;

        return Inertia::render('LectureResult', [
            'correctAnswered' => (int)$numCorrectAnswered,
            'incorrectAnswered' => (int)$numIncorrectAnswered,
            'allAnswered' => (int)$numCorrectAnswered + (int)$numIncorrectAnswered,
            'lecture' => (int)$currentLecture,
            'unit' => $currentUnit,
            'isHighestLectureInUnit' => $isHighestLectureInUnit,
            'bestScore' => (int)$totalCorrectAnswers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
