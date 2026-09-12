<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Inertia\Inertia;
use Inertia\Response;

class PasswordController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('Account/Password');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', PasswordRule::min(6)],
        ], [
            'password.confirmed' => 'Senhas não conferem!',
        ]);

        $request->user()->update([
            'password' => $request->string('password'),
        ]);

        return back()->with('success', 'Senha alterada com sucesso!');
    }
}
