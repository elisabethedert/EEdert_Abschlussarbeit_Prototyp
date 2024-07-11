<?php

namespace App\Http\Controllers;

use App\Models\QuestionResults;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LectureOverviewController extends Controller
{
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
