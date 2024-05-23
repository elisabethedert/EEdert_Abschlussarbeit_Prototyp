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

    public function checkExistence(Request $request) {
        $requestdata = $request->all();

        $questionResult = QuestionResults::where('user', $requestdata['user_id'])
            ->where('question_id', $requestdata['question_id'])
            ->first();

        if ($questionResult) {
            return response()->json(['status' => 'success', 'data' => $questionResult]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No record found']);
        }
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
    public function updateCounter(Request $request, QuestionResults $questionResults)
    {
        $requestdata = $request->all();
        $editQuestionCount = QuestionResults::where('user', $requestdata['user_id'])
        ->where('question_id', $requestdata['question_id'])
        ->first();
        $editQuestionCount->question_count = $requestdata['question_count']++;
        //if Frage richtig
            //TODO
             $editQuestionCount->question_correct_count = $requestdata['question_correct_count']++;
        //if Frage falsch
            //TODO
             $editQuestionCount->question_incorrect_count = $requestdata['question_incorrect_count']++;
        $editQuestionCount->save();
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionResults $questionResults)
    {
        //
    }
}
