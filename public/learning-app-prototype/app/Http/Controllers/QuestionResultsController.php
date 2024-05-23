<?php

namespace App\Http\Controllers;

use App\Models\QuestionResults;
use Illuminate\Http\Request;

class QuestionResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $requestdata = $request->all();

        //save question as new record in database
        $newQuestionResult = new QuestionResults;
        $newQuestionResult->user = $requestdata['user_id'];
        $newQuestionResult->question_id = $requestdata['question_id'];
        $newQuestionResult->question_type = $requestdata['question_type'];
        $newQuestionResult->question_count = $requestdata['question_count'];
        $newQuestionResult->question_correct_count = $requestdata['question_correct_count'];
        $newQuestionResult->question_incorrect_count = $requestdata['question_incorrect_count'];
        $newQuestionResult->lecture = $requestdata['lecture'];
        $newQuestionResult->unit = $requestdata['unit'];

        $newQuestionResult->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(QuestionResults $questionResults)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuestionResults $questionResults)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuestionResults $questionResults)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionResults $questionResults)
    {
        //
    }
}
