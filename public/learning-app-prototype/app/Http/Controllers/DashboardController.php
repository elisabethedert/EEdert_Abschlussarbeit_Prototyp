<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionResults;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $sessionDates = QuestionResults::where('user_id', auth()->user()->id)
            // extract all dates and group them by date
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

        // $currentUnit = $firstLectureResult->unit;
        // $currentLecture = $firstLectureResult->lecture;

        // $lectureCount = Question::where('unit', $currentUnit)
        // ->where('lecture', $currentLecture)
        // ->count();

        // alle Lektionen aus Unit 1
        $lectures = Question::where('unit', 1)
            ->select('lecture')
            ->distinct()
            ->get();

        $lectureCount = $lectures->count();
        
        
        $currentLecture = QuestionResults::where('user_id', auth()->user()->id)
        ->where('unit', 1)
        ->max('lecture');
        Log::debug($currentLecture);

        return Inertia::render('Dashboard', [
            'streak' => $streak,
            'lectureCount' => (int)$lectureCount,
            'currentLecture' => (int)$currentLecture+1,
        ]);
    }
}
