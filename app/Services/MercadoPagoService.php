<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MercadoPagoService
{
    public function createPixPayment(User $user, float $amount): ?array
    {
        $token = config('indroid.mercadopago_token');

        if (! $token) {
            return null;
        }

        $response = Http::withToken($token)
            ->withHeaders(['X-Idempotency-Key' => (string) Str::uuid()])
            ->acceptJson()
            ->post('https://api.mercadopago.com/v1/payments', [
                'transaction_amount' => $amount,
                'description' => 'Acesso inDROID',
                'payment_method_id' => 'pix',
                'payer' => [
                    'email' => $user->email,
                ],
                'external_reference' => (string) $user->id,
            ]);

        if (! $response->successful()) {
            return null;
        }

        $payload = $response->json();

        Payment::query()->create([
            'user_id' => $user->id,
            'payment_id' => (string) ($payload['id'] ?? ''),
            'status' => $payload['status'] ?? 'pending',
            'payment_info' => $payload,
        ]);

        $user->update([
            'payment_id' => (string) ($payload['id'] ?? ''),
        ]);

        return $payload;
    }

    public function handleNotification(string $paymentId): void
    {
        $token = config('indroid.mercadopago_token');

        if (! $token) {
            return;
        }

        $response = Http::withToken($token)
            ->acceptJson()
            ->get('https://api.mercadopago.com/v1/payments/'.$paymentId);

        if (! $response->successful()) {
            return;
        }

        $payload = $response->json();
        $status = $payload['status'] ?? 'pending';

        Payment::query()->create([
            'user_id' => User::query()->where('payment_id', $paymentId)->value('id'),
            'payment_id' => $paymentId,
            'status' => $status,
            'payment_info' => $payload,
        ]);

        if ($status === 'approved') {
            User::query()
                ->where('payment_id', $paymentId)
                ->where('status', 'pending')
                ->update(['status' => 'active']);
        }
    }

    public function ticketUrlFor(User $user): ?string
    {
        $payment = Payment::query()
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        return data_get($payment?->payment_info, 'point_of_interaction.transaction_data.ticket_url');
    }
}
