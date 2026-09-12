<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:300'],
        ]);

        Message::query()->create([
            'email' => Str::lower($data['email']),
            'message' => $data['message'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Mensagem enviada com sucesso, entraremos em contato em breve.');
    }
}
