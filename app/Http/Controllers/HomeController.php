<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home');
    }

    public function terms(): Response
    {
        return Inertia::render('Terms');
    }

    public function pending(): Response
    {
        return Inertia::render('Pending');
    }
}
