<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="inDROID — o robô mais inteligente da web. Surpreenda seus amigos com um jogo de perguntas e respostas.">
        <link rel="icon" href="/images/logo.svg" type="image/svg+xml">
        <title inertia>{{ config('app.name', 'inDROID') }}</title>
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @inertiaHead
    </head>
    <body class="antialiased bg-ink text-slate-100">
        @inertia
    </body>
</html>
