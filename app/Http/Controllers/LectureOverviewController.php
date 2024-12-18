<?php

namespace App\Http\Controllers;

use App\Models\QuestionResults;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * Class LectureOverviewController contains logik for the lecture overview (unit) view
 */
class LectureOverviewController
{
    /**
     * Display the lecture overview.
     */
    public function index(Request $request)
    {
        $highestLectureInUnit = QuestionResults::where('unit', $request->route('unit'))
            ->where('user_id', $request->user()->id)
            ->max('lecture');

        return Inertia::render('LectureOverview', [
            'highestLectureInUnit' => $highestLectureInUnit,
        ]);
    }
}
