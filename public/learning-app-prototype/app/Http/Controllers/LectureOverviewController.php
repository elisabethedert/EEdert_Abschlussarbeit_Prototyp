<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LectureOverviewController extends Controller
{
    public function index()
    {
        return Inertia::render('LectureOverview');
    }
}
