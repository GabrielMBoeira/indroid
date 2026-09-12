<?php

return [
    'price' => (float) env('INDROID_PRICE', 5.00),
    'payment_link' => env('MERCADOPAGO_PAYMENT_LINK', 'https://mpago.la/2bzTRGg'),
    'mercadopago_token' => env('MERCADOPAGO_ACCESS_TOKEN'),
    'admin_email' => env('ADMIN_EMAIL', 'gabrielmboeira@gmail.com'),
];
