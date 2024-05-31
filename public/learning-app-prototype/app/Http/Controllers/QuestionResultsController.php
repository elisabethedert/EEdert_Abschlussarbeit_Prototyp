<?php

namespace App\Http\Controllers;

use App\Models\QuestionResults;
use Illuminate\Http\Request;
use App\Models\MultipleChoiceAnswer;
use Illuminate\Support\Facades\Log;

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
        $requestdata = $request->all(); // TODO: Validate Data

        // richtige Antwort der Frage finden wenn nicht null dann Antwort korekt
        $answerWasCorrect = MultipleChoiceAnswer::where('multiple_choice_question_id', $requestdata['question_id'])
            ->where('correct_answer', 1)
            ->where('id', $requestdata['answer_id'])
            ->first();

        //TODO: Drag and drop: type mit abfragen und in die Datenbank speichern

        // Frageergebnis in der Datenbank suchen, ob Frage bereits beantwortet
        $record = QuestionResults::where('user_id', $requestdata['user_id'])
            ->where('question_id', $requestdata['question_id'])
            ->first();

        //wenn es schon einen Eintrag gibt, dann die Werte erhöhen (wäre sonst null)
        if ($record) {
            $record->question_count = $record->question_count+1;
            $record->question_correct_count = $answerWasCorrect ? $record->question_correct_count+1 : $record->question_correct_count;
            $record->question_incorrect_count = $answerWasCorrect ? $record->question_incorrect_count : $record->question_incorrect_count+1;
            $record->save();
        } else {
            $newQuestionResult = new QuestionResults;
            $newQuestionResult->user_id = $requestdata['user_id'];
            $newQuestionResult->question_id = $requestdata['question_id'];
            $newQuestionResult->question_type = $requestdata['question_type'];
            $newQuestionResult->question_count = 1;
            $newQuestionResult->question_correct_count = $answerWasCorrect ? 1 : 0;
            $newQuestionResult->question_incorrect_count = $answerWasCorrect ? 0 : 1;
            $newQuestionResult->lecture = $requestdata['lecture'];
            $newQuestionResult->unit = $requestdata['unit'];

            $newQuestionResult->save();
        }
        return response()->noContent(200);
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
    public function update(Request $request)
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
