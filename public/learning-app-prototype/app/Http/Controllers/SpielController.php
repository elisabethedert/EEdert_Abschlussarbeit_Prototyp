<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class SpielController extends Controller
{
    public function index()
    {
        return Inertia::render('Spiel');
    }
}
