<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        $email = trim((string) $request->string('email'));
        $phone = trim((string) $request->string('phone'));

        $users = User::query()
            ->when($email || $phone, function ($query) use ($email, $phone) {
                $query->when($email, fn ($q) => $q->where('email', $email))
                    ->when($phone, fn ($q) => $q->orWhere('phone', $phone));
            }, fn ($query) => $query->where('status', '<>', 'active'))
            ->latest()
            ->get(['id', 'email', 'phone', 'status', 'created_at']);

        return Inertia::render('Admin/Users', [
            'users' => $users,
            'filters' => [
                'email' => $email,
                'phone' => $phone,
            ],
        ]);
    }

    public function activate(User $user): RedirectResponse
    {
        $user->update(['status' => 'active']);

        return back()->with('success', 'Liberado com sucesso!');
    }
}
