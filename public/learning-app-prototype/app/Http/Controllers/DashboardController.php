<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionResults;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $sessionCount = QuestionResults::where('user_id', auth()->user()->id)
            // nur das datum extrahieren
            ->select(DB::raw('DATE(created_at) as date'))
            ->groupBy('date')
            ->get()
            ->count();

        return Inertia::render('Dashboard', [
            'sessionCount' => $sessionCount,
        ]);
    }
}
