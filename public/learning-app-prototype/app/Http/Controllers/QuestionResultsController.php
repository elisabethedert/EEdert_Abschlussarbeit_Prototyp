<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionResults;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class QuestionResultsController contains logik for the question results
 */
class QuestionResultsController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestdata = $request->all();

        // search the question result in the database to see if the question has already been answered in the session
        $record = QuestionResults::where('user_id', $request->user()->id)
            ->where('question_id', $requestdata['question_id'])
            ->where('session', $requestdata['session'])
            ->first();

        // search whether the question has ever been answered before
        $recordWhole = QuestionResults::where('user_id', $request->user()->id)
            ->where('question_id', $requestdata['question_id'])
            ->first();

        // check if answer was correct
        if ($requestdata['question_type'] == 'mc') {
            $answerWasCorrect = Answer::where('question_id', $requestdata['question_id'])
                ->where('correct_answer', 1)
                ->where('id', $requestdata['answer_id'])
                ->first();
        } else if ($requestdata['question_type'] == 'dd') {

            // determine the current question and compare it with the answer sequence
            $currentQuestion = Question::where('id', $requestdata['question_id'])
                ->first();
            $answerWasCorrect = $currentQuestion->blanks === $requestdata['dropped_buttons'];
        }

        // if there is already an entry, then increase the values or make a new entry
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

        // add experience points
        // 3 points per correct answer in first time, 1 point for repteated correct answer, 0 points for wrong answer or already answered in this lecture session 
        if (!$recordWhole && $answerWasCorrect) {
            $user = User::where('id', $request->user()->id)
                ->first();

            $user->experience_points = $user->experience_points + 3;
            $user->save();
            return response()->json(['message' => 'firstcorrect'], 200);
        } else if ($recordWhole && $answerWasCorrect) {
            $user = User::where('id', $request->user()->id)
                ->first();

            $user->experience_points = $user->experience_points + 1;
            $user->save();
            return response()->json(['message' => 'repeatcorrect'], 200);
        } else {
            return response()->json(['message' => 'incorrect'], 200);
        }
    }
}
