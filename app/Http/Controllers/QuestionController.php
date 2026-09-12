<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class QuestionController extends Controller
{
    public function show(): Response
    {
        return Inertia::render('Question', [
            'status' => request()->user()?->status,
        ]);
    }
}
