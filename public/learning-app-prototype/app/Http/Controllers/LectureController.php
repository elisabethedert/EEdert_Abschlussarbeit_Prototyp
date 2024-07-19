<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionResults;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LectureController extends Controller
{
    /**
     * Display all questions of lecture in random order
     */
    public function index($lecture)
    {
        $questions = Question::where('lecture', $lecture)->inRandomOrder()->get();

        $questions->transform(function ($question) {

            //shuffle order of answers
            $answers = Answer::where('question_id', $question->id)->get()->shuffle();

            // don't show correct answer in frontend
            $question->answers = $answers->map(function ($answer) {
                unset($answer->correct_answer);
                return $answer;
            });

            // don't show correct order of blanks in frontend
            unset($question->blanks);

            return $question;
        });

        return Inertia::render('Lecture', [
            'questions' => $questions
        ]);
    }

    /**
     * Display the lecture result.
     */
    public function results(Request $request)
    {
        // number of correct answers in first try
        $numCorrectInFirstTry = QuestionResults::where('user_id', $request->user()->id)
            ->where('session', $request->route('session')) //sessionnummer
            ->where('question_incorrect_count', 0)
            ->count();

        // determine if the lecture already has results
        $firstLectureResult = QuestionResults::where('user_id', $request->user()->id)
            ->where('session', $request->route('session')) //sessionnummer
            ->first();

        if (!$firstLectureResult) {
            abort(404);
        }

        $currentUnit = $firstLectureResult->unit;
        $currentLecture = $firstLectureResult->lecture;

        
        $numLecturesInUnit = Question::where('unit', $currentUnit)
            ->max('lecture');

        // check if all lectures are processed
        if ($currentLecture === $numLecturesInUnit) {
            $isHighestLectureInUnit = true;
        } else {
            $isHighestLectureInUnit = false;
        }

        // best run trough lecture
        $bestScore = QuestionResults::where('user_id', $request->user()->id)
            ->where('lecture', $currentLecture)
            ->groupBy('session')
            ->select(DB::raw('SUM(question_correct_count) as total_correct_answers'))
            ->orderBy('total_correct_answers', 'desc')
            ->first();
        $totalCorrectAnswers = $bestScore->total_correct_answers;

        $lectureCount = Question::where('unit', $currentUnit)
        ->where('lecture', $currentLecture)
        ->count();

        // number of already processed lectures in unit
        $lectureAlreadyAnswered = QuestionResults::where('user_id', $request->user()->id)
            ->where('unit', $currentUnit)
            ->where('lecture', $currentLecture)
            ->distinct('session')
            ->count();

        return Inertia::render('LectureResult', [
            'lectureCount' => (int)$lectureCount,
            'correctAnsweredFirstTry' => $numCorrectInFirstTry,
            'numLecturesInUnit' => (int)$numLecturesInUnit,
            'lecture' => (int)$currentLecture,
            'lectureAlreadyAnswered' => (int)$lectureAlreadyAnswered,
            'unit' => $currentUnit,
            'isHighestLectureInUnit' => $isHighestLectureInUnit,
            'bestScore' => (int)$totalCorrectAnswers,
        ]);
    }
}
