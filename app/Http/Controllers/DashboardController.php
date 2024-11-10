<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionResults;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

/**
 * Class DashboardController contains logik for the dashboard view
 */
class DashboardController
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // extract all dates and group them by date
        $sessionDates = QuestionResults::where('user_id', auth()->user()->id)
            ->select(DB::raw('DATE(created_at) as date'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        // Carbon is a bibliothek to work with dates
        $currentDate = Carbon::today();
        $streak = 0;

        // calculate streak by comparing the current date with the dates from the database
        foreach ($sessionDates as $entry) {
            $entryDate = Carbon::parse($entry->date);

            if ($entryDate->eq($currentDate)) {
                $streak++;
                $currentDate->subDay();
            } else {
                break;
            }
        }

        // all lecture out of unit 1
        $lectures = Question::where('unit', 1)
            ->select('lecture')
            ->distinct()
            ->get();

        $lectureCount = $lectures->count();
        
        // highest already processed lecture
        $currentLecture = QuestionResults::where('user_id', auth()->user()->id)
        ->where('unit', 1)
        ->max('lecture');

        return Inertia::render('Dashboard', [
            'streak' => $streak,
            'lectureCount' => (int)$lectureCount,
            'currentLecture' => (int)$currentLecture,
        ]);
    }
}
