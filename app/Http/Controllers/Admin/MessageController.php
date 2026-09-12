<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class MessageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Messages', [
            'messages' => Message::query()
                ->where('status', 'pending')
                ->latest()
                ->get(['id', 'email', 'message', 'status', 'created_at']),
        ]);
    }

    public function destroy(Message $message): RedirectResponse
    {
        $message->markChecked();

        return back()->with('success', 'Mensagem marcada como lida.');
    }
}
