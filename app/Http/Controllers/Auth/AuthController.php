<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\MercadoPagoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    public function createLogin(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function storeLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials['email'] = Str::lower($credentials['email']);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Email não cadastrado ou senha incorreta!',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        /** @var User $user */
        $user = $request->user();

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.users'));
        }

        if (! $user->isActive()) {
            return redirect()->route('pending')->with('error', 'Usuário cadastrado, aguardando liberação!');
        }

        return redirect()->intended(route('question'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function createRegister(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function storeRegister(Request $request, MercadoPagoService $mercadoPago): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:30'],
            'password' => ['required', 'confirmed', PasswordRule::min(6)],
            'terms' => ['accepted'],
        ], [
            'email.unique' => 'Este e-mail já está cadastrado!',
            'password.confirmed' => 'Senhas não conferem!',
            'terms.accepted' => 'É necessário aceitar o termo de responsabilidade.',
        ]);

        $user = User::query()->create([
            'name' => Str::before($data['email'], '@'),
            'email' => Str::lower($data['email']),
            'phone' => $data['phone'],
            'password' => $data['password'],
            'status' => 'pending',
            'is_admin' => false,
        ]);

        Auth::login($user);

        $payment = $mercadoPago->createPixPayment($user, (float) config('indroid.price'));
        $ticketUrl = data_get($payment, 'point_of_interaction.transaction_data.ticket_url');

        if ($ticketUrl) {
            return redirect()->away($ticketUrl);
        }

        return redirect()->route('pending')->with('success', 'Cadastro efetuado com sucesso. Conclua o pagamento para liberar o acesso.');
    }

    public function createForgotPassword(): Response
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    public function storeForgotPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = Str::lower($request->string('email'));

        if (! User::query()->where('email', $email)->exists()) {
            return back()->withErrors([
                'email' => 'Email não cadastrado!',
            ]);
        }

        $status = Password::sendResetLink(['email' => $email]);

        if ($status !== Password::RESET_LINK_SENT) {
            return back()->with('error', 'Não foi possível enviar o e-mail de recuperação. Tente novamente.');
        }

        return back()->with('success', 'Email de recuperação de senha enviado!');
    }

    public function createResetPassword(Request $request, string $token): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'token' => $token,
            'email' => $request->string('email'),
        ]);
    }

    public function storeResetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(6)],
        ], [
            'password.confirmed' => 'Senhas não conferem!',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => $request->string('password'),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return back()->withErrors(['email' => 'Não foi possível alterar a senha. Verifique o link.']);
        }

        return redirect()->route('login')->with('success', 'Senha alterada com sucesso. Acesse o login!');
    }
}
