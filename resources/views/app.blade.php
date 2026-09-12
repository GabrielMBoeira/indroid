<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Manezinho Ixtepô — o pescador mais brincalhão da Ilha da Magia. Surpreenda seus amigos com um jogo de perguntas e respostas.">
        <link rel="icon" href="/images/ixtepo-logo.png" type="image/png">
        <title inertia>{{ config('app.name', 'Manezinho Ixtepô') }}</title>
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @inertiaHead
    </head>
    <body class="antialiased bg-ink text-orange-50">
        @inertia
    </body>
</html>
