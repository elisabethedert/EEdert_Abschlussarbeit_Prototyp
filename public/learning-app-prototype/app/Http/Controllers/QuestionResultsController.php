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
        $newQuestionResult->user_id = $requestdata['user_id'];
        $newQuestionResult->question_id = $requestdata['question_id'];
        $newQuestionResult->question_type = $requestdata['question_type'];
        $newQuestionResult->question_count = $requestdata['question_count'];
        $newQuestionResult->question_correct_count = $requestdata['question_correct_count'];
        $newQuestionResult->question_incorrect_count = $requestdata['question_incorrect_count'];
        $newQuestionResult->lecture = $requestdata['lecture'];
        $newQuestionResult->unit = $requestdata['unit'];

        $newQuestionResult->save();
    }

    public function checkExistence(Request $request)
    {
        $requestdata = $request->all();

        $questionResult = QuestionResults::where('user_id', $requestdata['user_id'])
            ->where('question_id', $requestdata['question_id'])
            ->first();

        if ($questionResult) {
            return response()->json(['status' => 'success', 'data' => $questionResult]);
        } else {
            return response()->json(['status' => 'error', 'data' => $questionResult]);
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
    public function updateCounter(Request $request)
    {
        // Validierung der eingehenden Anfrage
        $validatedData = $request->validate([
            'question_id' => 'required|integer',
            'user_id' => 'required|integer',
            'question_count' => 'required|integer',
            'question_correct_count' => 'required|integer',
            'question_incorrect_count' => 'required|integer',
        ]);

        // Debugging-Log hinzufügen
        // \Log::info('UpdateCounter request data:', $validatedData);

        // Suche nach dem vorhandenen Eintrag
        $editQuestionCount = QuestionResults::where('question_id', $validatedData['question_id'])
            ->where('user_id', $validatedData['user_id'])
            ->first();

        $editQuestionCount->question_count = $validatedData['question_count'];
        $editQuestionCount->question_correct_count = $validatedData['question_correct_count'];
        $editQuestionCount->question_incorrect_count = $validatedData['question_incorrect_count'];
        $editQuestionCount->save();
        return response()->json(['status' => 'erfolgreich geupdated']);


        // public function updateCounter(Request $request, QuestionResults $questionResults)
        // {
        //     $requestdata = $request->all();
        //     $editQuestionCount = QuestionResults::where('question_id', $requestdata['question_id'])
        //         ->where('user_id', $requestdata['user_id'])
        //         ->first();
        //     $editQuestionCount->question_count = $requestdata['question_count'];
        //     $editQuestionCount->question_correct_count = $requestdata['question_correct_count'];
        //     $editQuestionCount->question_incorrect_count = $requestdata['question_incorrect_count'];
        //     $editQuestionCount->save();
        //     return response()->json(['status' => 'erfolgreich geupdated']);
        // }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionResults $questionResults)
    {
        //
    }
}
