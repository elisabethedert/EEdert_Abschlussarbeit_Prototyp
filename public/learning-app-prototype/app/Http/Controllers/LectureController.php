<?php

namespace App\Http\Controllers;

use App\Models\DragDropQuestion;
use Illuminate\Http\Request;
use App\Models\MultipleChoiceQuestion;
use Inertia\Inertia;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($lecture)
    {
        $questionsMc = MultipleChoiceQuestion::where('lecture', $lecture)->inRandomOrder()->get();
        $questionsDd = DragDropQuestion::where('lecture', $lecture)->inRandomOrder()->get();

        //filter to remove correct answer from the response
        $questionsMc->transform(function ($question) {
            $question->multiple_choice_answers->transform(function ($answer) {
                unset($answer->correct_answer);
                return $answer;
            });
            return $question;
        });

        // $questionsDd = $questionsDd->map(function ($question) {
        //     $shuffledBlanks = $question->blanks;
        //     shuffle($shuffledBlanks);
        //     $question->blanks = $shuffledBlanks;
        //     return $question;
        // });

        // merge question types and shuffle them
        $questions = $questionsDd->concat($questionsMc)->shuffle();

        //View to see by the User
        return Inertia::render('Lecture', [
            'questions' => $questions
        ]);
    }

    public function results(Request $request)
    {
        $score = $request[0]['results']['score'];
        $totalQuestions = $request[0]['results']['totalQuestions'];
        $percentage = ceil(($score / $totalQuestions) * 100);

        $comment = match (true) {
            $percentage >= 80 && $percentage <= 100 => 'Sehr gut',
            $percentage >= 60 && $percentage <= 79 => 'Gut',
            $percentage >= 40 && $percentage <= 59 => 'Ok',
            $percentage < 39 => 'schlecht',
            default => 'Well how did you reach here?'
        };

        return Inertia::render('LectureResult', [
            'percentage' => $percentage,
            'comment' => $comment,
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
