<?php

namespace App\Http\Controllers;

use App\Models\DragDropAnswer;
use App\Models\DragDropQuestion;
use Illuminate\Http\Request;
use App\Models\MultipleChoiceQuestion;
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
        $questionsMc = MultipleChoiceQuestion::where('lecture', $lecture)->inRandomOrder()->get();
        $questionsDd = DragDropQuestion::where('lecture', $lecture)->inRandomOrder()->get();
        // Möglichkeit unter alle Fragen die falsch beantworteten der letzten Lektionen untermischen aus der letzten Session mit dem höchsten Timestamp

        //filter to remove correct answer from the response
        $questionsMc->transform(function ($question) {
            $question->multiple_choice_answers->transform(function ($answer) {
                unset($answer->correct_answer);
                return $answer;
            });
            return $question;
        });

        $questionsDd->transform(function ($question) {
            unset($question->blanks);
            $question->drag_drop_answers = DragDropAnswer::where('drag_drop_question_id', $question->id)->pluck('answer');
            return $question;
        });

        // merge question types and shuffle them
        $questions = $questionsDd->concat($questionsMc)->shuffle();

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
        $highestLectureInUnit = MultipleChoiceQuestion::where('unit', $currentUnit)
            ->max('lecture');

        $checkIfLastLecture = $firstLectureResult->lecture;

        if ($highestLectureInUnit === $checkIfLastLecture) {
            $isHighestLectureInUnit = true;
        } else {
            $isHighestLectureInUnit = false;
        }

        $lecture = $firstLectureResult->lecture;

        $user = User::where('id', $request->user()->id)
            ->first();

        $highestLecture = QuestionResults::where('user_id', auth()->user()->id)
            ->max('lecture');

        $user->current_lecture = $highestLecture + 1;
        $user->save();

        // $bestScore = QuestionResults::where('user_id', $request->user()->id)
        //     ->whereIn('lecture', [$lecture])
        //     ->where('session', $request->route('session'))
        //     ->groupBy('session')
        //     ->select(DB::raw('SUM(question_correct_count) as total_correct_answers'))
        //     ->orderBy('total_correct_answers', 'desc')
        //     ->first();

        return Inertia::render('LectureResult', [
            'correctAnswered' => (int)$numCorrectAnswered,
            'incorrectAnswered' => (int)$numIncorrectAnswered,
            'allAnswered' => (int)$numCorrectAnswered + (int)$numIncorrectAnswered,
            'lecture' => (int)$lecture,
            'unit' => $currentUnit,
            'isHighestLectureInUnit' => $isHighestLectureInUnit,
            // 'bestScore' => (int)$bestScore,
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
