<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class UnitController extends Controller
{
    public function index()
    {
        return Inertia::render('Unit');
    }
}
