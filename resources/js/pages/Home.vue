<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';
import TypedText from '../Components/TypedText.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Home" />
    <AppLayout background="/images/neon.jpg">
        <section class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-10 lg:grid-cols-2 lg:py-16">
            <div>
                <p class="mb-3 inline-flex rounded-full border border-neon/40 bg-neon/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-neon">
                    Inteligência Artificial
                </p>
                <h1 class="font-display text-5xl font-extrabold tracking-wide text-white md:text-7xl">inDROID</h1>
                <div class="mt-6 min-h-16 text-2xl font-semibold text-white md:text-3xl">
                    <TypedText />
                </div>
                <p class="mt-6 max-w-xl text-lg text-slate-200">
                    Experimente e impressione seus amigos! O robô mais inteligente da web responde o impossível — e deixa todo mundo sem reação.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <Link href="/cadastro" class="rounded-full bg-neon px-6 py-3 text-sm font-bold text-ink hover:bg-cyan-300">
                        Use sua imaginação
                    </Link>
                    <Link href="/termo" class="rounded-full border border-white/20 px-6 py-3 text-sm font-semibold text-white hover:border-neon">
                        Como funciona
                    </Link>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 rounded-[2rem] bg-neon/20 blur-2xl"></div>
                <img src="/images/robot-head.jpg" alt="Robô inDROID com visor iluminado" class="relative z-10 w-full rounded-[2rem] object-cover shadow-2xl neon-border" />
            </div>
        </section>

        <section class="mx-auto max-w-6xl px-4 pb-16">
            <h2 class="mb-8 text-center font-display text-2xl text-white">Como impressionar a galera</h2>
            <div class="grid gap-6 md:grid-cols-3">
                <article class="overflow-hidden rounded-3xl glass-card">
                    <img src="/images/friends.jpg" alt="Amigos se divertindo juntos" class="h-44 w-full object-cover" />
                    <div class="p-5">
                        <h3 class="font-semibold text-white">1. Pense na pergunta</h3>
                        <p class="mt-2 text-sm text-slate-300">Escolha uma pergunta cuja resposta você já sabe e prepare o momento.</p>
                    </div>
                </article>
                <article class="overflow-hidden rounded-3xl glass-card">
                    <img src="/images/tech.jpg" alt="Interface tecnológica do robô" class="h-44 w-full object-cover" />
                    <div class="p-5">
                        <h3 class="font-semibold text-white">2. Digite a resposta</h3>
                        <p class="mt-2 text-sm text-slate-300">O inDROID gera uma frase aleatória enquanto você registra a resposta em segredo.</p>
                    </div>
                </article>
                <article class="overflow-hidden rounded-3xl glass-card">
                    <img src="/images/robot-lab.jpg" alt="Laboratório com inteligência artificial" class="h-44 w-full object-cover" />
                    <div class="p-5">
                        <h3 class="font-semibold text-white">3. Aperte o ponto</h3>
                        <p class="mt-2 text-sm text-slate-300">Use a tecla ponto para assumir o controle e deixar o robô responder na hora.</p>
                    </div>
                </article>
            </div>
        </section>

        <section class="mx-auto grid max-w-6xl gap-4 px-4 pb-20 md:grid-cols-4">
            <img src="/images/robot-human.jpg" alt="Robô humanóide em destaque" class="h-52 w-full rounded-3xl object-cover neon-border md:col-span-1" />
            <img src="/images/ai.jpg" alt="Rede neural e inteligência artificial" class="h-52 w-full rounded-3xl object-cover md:col-span-1" />
            <img src="/images/circuit.jpg" alt="Circuitos eletrônicos" class="h-52 w-full rounded-3xl object-cover md:col-span-1" />
            <img src="/images/robot-toy.jpg" alt="Robô branco do inDROID" class="h-52 w-full rounded-3xl object-cover md:col-span-1" />
        </section>
    </AppLayout>
</template>
