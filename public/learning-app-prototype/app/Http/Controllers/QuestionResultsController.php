<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionResults;
use App\Models\User;
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
        $record = QuestionResults::where('user_id', $request->user()->id)
            ->where('question_id', $requestdata['question_id'])
            ->where('question_type', $requestdata['question_type'])
            ->where('session', $requestdata['session'])
            ->first();

        $addPoints = QuestionResults::where('user_id', $request->user()->id)
            ->where('question_id', $requestdata['question_id'])
            ->where('question_type', $requestdata['question_type'])
            ->first();

        if (!$addPoints) {
            $user = User::where('id', $request->user()->id)
                ->first();

            $user->experience_points = $user->experience_points + 3; //3 Points pro Frage richtig
            $user->save();
        } else {
            $user = User::where('id', $request->user()->id)
                ->first();

            $user->experience_points = $user->experience_points + 1; //1 Points pro Frage richtig
            $user->save();
        }

        if ($requestdata['question_type'] == 'mc') {

            // richtige Antwort der Frage finden wenn nicht null dann Antwort korekt
            $answerWasCorrect = Answer::where('question_id', $requestdata['question_id'])
                ->where('correct_answer', 1)
                ->where('id', $requestdata['answer_id'])
                ->first();
        } else if ($requestdata['question_type'] == 'dd') {

            // Derzeitige Frage ermitteln und mit der Antwortsreihenfolge vergleichen
            $currentQuestion = Question::where('id', $requestdata['question_id'])
                ->first();
            $answerWasCorrect = $currentQuestion->blanks === $requestdata['dropped_buttons'];
        }
        //wenn es schon einen Eintrag gibt, dann die Werte erhöhen (wäre sonst null)
        if ($record) {
            $record->question_count = $record->question_count + 1;
            $record->question_correct_count = $answerWasCorrect ? $record->question_correct_count + 1 : $record->question_correct_count;
            $record->question_incorrect_count = $answerWasCorrect ? $record->question_incorrect_count : $record->question_incorrect_count + 1;
            $record->save();
        } else {
            $newQuestionResult = new QuestionResults;
            $newQuestionResult->user_id = $request->user()->id;
            $newQuestionResult->question_id = $requestdata['question_id'];
            $newQuestionResult->question_type = $requestdata['question_type'];
            $newQuestionResult->question_count = 1;
            $newQuestionResult->question_correct_count = $answerWasCorrect ? 1 : 0;
            $newQuestionResult->question_incorrect_count = $answerWasCorrect ? 0 : 1;
            $newQuestionResult->lecture = $requestdata['lecture'];
            $newQuestionResult->unit = $requestdata['unit'];
            $newQuestionResult->session = $requestdata['session'];

            $newQuestionResult->save();
        }
        if ($answerWasCorrect) {
            return response()->json(['message' => 'correct'], 200);
        } else {
            return response()->json(['message' => 'incorrect'], 200);
        }
        // } else if ($requestdata['question_type'] == 'dd') {

        //     // Derzeitige Frage ermitteln und mit der Antwortsreihenfolge vergleichen
        //     $currentQuestion = DragDropQuestion::where('id', $requestdata['question_id'])
        //         ->first();
        //     $orderCorrect = $currentQuestion->blanks === $requestdata['dropped_buttons'];

        //     //wenn es schon einen Eintrag gibt, dann die Werte erhöhen (wäre sonst null)
        //     if ($record) {
        //         $record->question_count = $record->question_count + 1;
        //         $record->question_correct_count = $orderCorrect ? $record->question_correct_count + 1 : $record->question_correct_count;
        //         $record->question_incorrect_count = $orderCorrect ? $record->question_incorrect_count : $record->question_incorrect_count + 1;
        //         $record->save();
        //     } else {
        //         $newQuestionResult = new QuestionResults;
        //         $newQuestionResult->user_id = $request->user()->id;
        //         $newQuestionResult->question_id = $requestdata['question_id'];
        //         $newQuestionResult->question_type = $requestdata['question_type'];
        //         $newQuestionResult->question_count = 1;
        //         $newQuestionResult->question_correct_count = $orderCorrect ? 1 : 0;
        //         $newQuestionResult->question_incorrect_count = $orderCorrect ? 0 : 1;
        //         $newQuestionResult->lecture = $requestdata['lecture'];
        //         $newQuestionResult->unit = $requestdata['unit'];
        //         $newQuestionResult->session = $requestdata['session'];

        //         $newQuestionResult->save();
        //     }
        //     if ($orderCorrect) {
        //         return response()->json(['message' => 'orderCorrect'], 200);
        //     } else {
        //         return response()->json(['message' => $requestdata['dropped_buttons']], 200);
        //     }
        // }
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
