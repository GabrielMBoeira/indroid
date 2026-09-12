<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';
import TypedText from '../Components/TypedText.vue';
</script>

<template>
    <Head title="Home" />
    <AppLayout background="/images/ixtepo-sunset.jpg">
        <section class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-10 lg:grid-cols-2 lg:py-16">
            <div>
                <p class="mb-3 inline-flex rounded-full border border-neon/50 bg-neon/15 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-neon">
                    Manezinho da ilha
                </p>
                <h1 class="font-display text-4xl font-semibold tracking-wide text-white md:text-6xl">Manezinho Ixtepô</h1>
                <div class="mt-6 min-h-16 text-2xl font-semibold text-white md:text-3xl">
                    <TypedText />
                </div>
                <p class="mt-6 max-w-xl text-lg text-orange-50">
                    Ixtepô, tchê! O pescador mais brincalhão da Ilha da Magia adivinha tudo — e deixa a galera sem reação.
                    Experimenta e impressiona teus amigos com o sotaque mais gostoso de Santa Catarina.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <Link href="/cadastro" class="rounded-full bg-neon px-6 py-3 text-sm font-bold text-ink hover:bg-amber-300">
                        Bora pescar a resposta
                    </Link>
                    <Link href="/termo" class="rounded-full border border-white/20 px-6 py-3 text-sm font-semibold text-white hover:border-neon">
                        Como funciona
                    </Link>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 rounded-[2rem] bg-neon/25 blur-2xl"></div>
                <img src="/images/ixtepo-hero.jpg" alt="Ixtepô, o manezinho pescador brincalhão" class="relative z-10 w-full rounded-[2rem] object-cover shadow-2xl neon-border" />
            </div>
        </section>

        <section class="mx-auto max-w-6xl px-4 pb-16">
            <h2 class="mb-8 text-center font-display text-2xl text-white">Como impressionar a galera da ilha</h2>
            <div class="grid gap-6 md:grid-cols-3">
                <article class="overflow-hidden rounded-3xl glass-card">
                    <img src="/images/ixtepo-friends.jpg" alt="Ixtepô contando causo com os amigos no píer" class="h-44 w-full object-cover" />
                    <div class="p-5">
                        <h3 class="font-semibold text-white">1. Pense na pergunta</h3>
                        <p class="mt-2 text-sm text-orange-100">Escolha uma pergunta cuja resposta você já sabe e prepare o momento.</p>
                    </div>
                </article>
                <article class="overflow-hidden rounded-3xl glass-card">
                    <img src="/images/ixtepo-think.jpg" alt="Ixtepô pensando numa resposta engraçada" class="h-44 w-full object-cover" />
                    <div class="p-5">
                        <h3 class="font-semibold text-white">2. Digite a resposta</h3>
                        <p class="mt-2 text-sm text-orange-100">O Ixtepô gera um causo aleatório enquanto você registra a resposta em segredo.</p>
                    </div>
                </article>
                <article class="overflow-hidden rounded-3xl glass-card">
                    <img src="/images/ixtepo-boat.jpg" alt="Ixtepô no barco com um peixe enorme" class="h-44 w-full object-cover" />
                    <div class="p-5">
                        <h3 class="font-semibold text-white">3. Aperte o ponto</h3>
                        <p class="mt-2 text-sm text-orange-100">Use a tecla ponto para assumir o controle e deixar o manezinho responder na hora.</p>
                    </div>
                </article>
            </div>
        </section>

        <section class="mx-auto grid max-w-6xl gap-4 px-4 pb-20 md:grid-cols-4">
            <img src="/images/ixtepo-beach.jpg" alt="Ixtepô na praia com a vara de pesca" class="h-52 w-full rounded-3xl object-cover neon-border" />
            <img src="/images/ixtepo-closeup.jpg" alt="Close do sorriso brincalhão do Ixtepô" class="h-52 w-full rounded-3xl object-cover" />
            <img src="/images/ixtepo-boat.jpg" alt="Ixtepô pescando na canoa" class="h-52 w-full rounded-3xl object-cover" />
            <img src="/images/ixtepo-sunset.jpg" alt="Ixtepô acenando no pôr do sol da ilha" class="h-52 w-full rounded-3xl object-cover" />
        </section>
    </AppLayout>
</template>
