<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MultipleChoiceQuestion;
use Inertia\Inertia;

class SpielController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = MultipleChoiceQuestion::with(['multiple_choice_answers'=>function($query) {
            $query->inRandomOrder();
        }])->inRandomOrder()->get();
        //View to see by the User
        return Inertia::render('Spiel', [
            'questions' => $questions
        ]); 
    }

    public function results(Request $request)
    {
        $score = $request[0]['results']['score'];
        $totalQuestions = $request[0]['results']['totalQuestions'];
        $percentage = ceil(($score/$totalQuestions)*100);

        $comment = match(true) {
            $percentage>=80 && $percentage<=100 => 'Sehr gut',
            $percentage>=60 && $percentage<=79 => 'Gut',
            $percentage>=40 && $percentage<=59 => 'Ok',
            $percentage<39 => 'schlecht',
            default=>'Well how did you reach here?'
        };

        return Inertia::render('LectureResult', [
            'percentage'=>$percentage,
            'comment'=>$comment,
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
