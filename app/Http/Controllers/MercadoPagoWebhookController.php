<?php

namespace App\Http\Controllers;

use App\Services\MercadoPagoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MercadoPagoWebhookController extends Controller
{
    public function __invoke(Request $request, MercadoPagoService $mercadoPago): Response
    {
        $paymentId = $request->input('data.id', $request->input('data_id'));

        if (! $paymentId) {
            return response('Requisição não mapeada', 400);
        }

        $mercadoPago->handleNotification((string) $paymentId);

        return response('ok');
    }
}
