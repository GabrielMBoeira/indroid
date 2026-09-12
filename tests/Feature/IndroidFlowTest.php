<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class IndroidFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('Home'));
    }

    public function test_user_can_register_and_is_pending(): void
    {
        $this->post('/cadastro', [
            'email' => 'novo@indroid.com.br',
            'phone' => '(48) 99999.1111',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'terms' => '1',
        ])->assertRedirect(route('pending'));

        $this->assertDatabaseHas('users', [
            'email' => 'novo@indroid.com.br',
            'status' => 'pending',
            'is_admin' => 0,
        ]);
    }

    public function test_register_rejects_mismatched_passwords(): void
    {
        $this->from('/cadastro')->post('/cadastro', [
            'email' => 'novo@indroid.com.br',
            'phone' => '(48) 99999.1111',
            'password' => 'secret123',
            'password_confirmation' => 'outra',
            'terms' => '1',
        ])->assertRedirect('/cadastro')->assertSessionHasErrors('password');
    }

    public function test_active_user_can_login_and_see_question(): void
    {
        $user = User::factory()->create([
            'email' => 'ativo@indroid.com.br',
            'password' => 'password',
            'status' => 'active',
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('question'));

        $this->get('/perguntar')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('Question'));
    }

    public function test_pending_user_is_sent_to_pending_page(): void
    {
        $user = User::factory()->pending()->create([
            'email' => 'espera@indroid.com.br',
            'password' => 'password',
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('pending'));

        $this->get('/perguntar')->assertRedirect(route('pending'));
    }

    public function test_admin_can_activate_a_user(): void
    {
        $admin = User::factory()->admin()->create([
            'email' => 'admin@indroid.com.br',
            'password' => 'password',
        ]);
        $pending = User::factory()->pending()->create();

        $this->actingAs($admin)
            ->post(route('admin.users.activate', $pending))
            ->assertRedirect();

        $this->assertEquals('active', $pending->fresh()->status);
    }

    public function test_guest_cannot_access_admin(): void
    {
        $this->get('/admin/usuarios')->assertRedirect(route('login'));
    }

    public function test_contact_stores_a_message(): void
    {
        $this->from('/contato')->post('/contato', [
            'email' => 'amigo@indroid.com.br',
            'message' => 'Quero saber como jogar.',
        ])->assertRedirect('/contato')->assertSessionHas('success');

        $this->assertDatabaseHas('messages', [
            'email' => 'amigo@indroid.com.br',
            'status' => 'pending',
        ]);
    }

    public function test_admin_can_mark_message_as_checked(): void
    {
        $admin = User::factory()->admin()->create();
        $message = Message::query()->create([
            'email' => 'amigo@indroid.com.br',
            'message' => 'Olá',
            'status' => 'pending',
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.messages.destroy', $message))
            ->assertRedirect();

        $this->assertEquals('check', $message->fresh()->status);
    }

    public function test_user_can_change_password(): void
    {
        $user = User::factory()->create(['password' => 'password']);

        $this->actingAs($user)->put('/alterar-senha', [
            'password' => 'nova-senha',
            'password_confirmation' => 'nova-senha',
        ])->assertRedirect()->assertSessionHas('success');

        $this->post('/logout');

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'nova-senha',
        ])->assertRedirect(route('question'));
    }

    public function test_password_reset_link_is_sent_for_existing_email(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->from('/esqueci-senha')->post('/esqueci-senha', [
            'email' => $user->email,
        ])->assertRedirect('/esqueci-senha')->assertSessionHas('success');
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        $user = User::factory()->create();
        $token = Password::createToken($user);

        $this->post('/redefinir-senha', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'resetada123',
            'password_confirmation' => 'resetada123',
        ])->assertRedirect(route('login'));
    }

    public function test_old_urls_redirect(): void
    {
        $this->get('/home')->assertRedirect('/');
        $this->get('/user_register')->assertRedirect('/cadastro');
        $this->get('/question')->assertRedirect('/perguntar');
    }
}
