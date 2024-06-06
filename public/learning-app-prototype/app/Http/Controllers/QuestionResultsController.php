<?php

namespace App\Http\Controllers;

use App\Models\DragDropAnswer;
use App\Models\DragDropQuestion;
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

        // Frageergebnis in der Datenbank suchen, ob Frage bereits beantwortet
        $record = QuestionResults::where('user_id', $requestdata['user_id'])
            ->where('question_id', $requestdata['question_id'])
            ->where('question_type', $requestdata['question_type'])
            ->first();

        if ($requestdata['question_type'] == 'mc') {

            // richtige Antwort der Frage finden wenn nicht null dann Antwort korekt
            $answerWasCorrect = MultipleChoiceAnswer::where('multiple_choice_question_id', $requestdata['question_id'])
                ->where('correct_answer', 1)
                ->where('id', $requestdata['answer_id'])
                ->first();

            //wenn es schon einen Eintrag gibt, dann die Werte erhöhen (wäre sonst null)
            if ($record) {
                $record->question_count = $record->question_count + 1;
                $record->question_correct_count = $answerWasCorrect ? $record->question_correct_count + 1 : $record->question_correct_count;
                $record->question_incorrect_count = $answerWasCorrect ? $record->question_incorrect_count : $record->question_incorrect_count + 1;
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
            if ($answerWasCorrect) {
                return response()->json(['message' => 'correct'], 200);
            } else {
                return response()->json(['message' => 'incorrect'], 200);
            }
        } else if ($requestdata['question_type'] == 'dd') {

            //TODO: prüfen ob Antwort korrekt war
            // $droppedButtonsOrder = json_encode($requestdata['dropped_buttons']);
            // $droppedButtonsOrder = str_replace(',', ', ', $droppedButtonsOrder);

            // findet bisher keinen passenden Eintrag
            $orderCorrect = DragDropQuestion::where('id', $requestdata['question_id'])
                ->where('blanks', $requestdata['dropped_buttons'])
                ->first();

            //wenn es schon einen Eintrag gibt, dann die Werte erhöhen (wäre sonst null)
            if ($record) {
                $record->question_count = $record->question_count + 1;
                $record->question_correct_count = 0;
                $record->question_incorrect_count = 0;
                $record->save();
            } else {
                $newQuestionResult = new QuestionResults;
                $newQuestionResult->user_id = $requestdata['user_id'];
                $newQuestionResult->question_id = $requestdata['question_id'];
                $newQuestionResult->question_type = $requestdata['question_type'];
                $newQuestionResult->question_count = 1;
                $newQuestionResult->question_correct_count = 0;
                $newQuestionResult->question_incorrect_count = 0;
                $newQuestionResult->lecture = $requestdata['lecture'];
                $newQuestionResult->unit = $requestdata['unit'];

                $newQuestionResult->save();
            }
            if ($orderCorrect) {
                return response()->json(['message' => 'orderCorrect'], 200);
            } else {
                return response()->json(['message' => $requestdata['dropped_buttons']], 200);
            }
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
