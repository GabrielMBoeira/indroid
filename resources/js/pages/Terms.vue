<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';
</script>

<template>
    <Head title="Termo de responsabilidade" />
    <AppLayout background="/images/robot-human.jpg">
        <div class="mx-auto grid max-w-5xl items-start gap-8 px-4 py-12 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="rounded-3xl glass-card p-8">
                <h1 class="font-display text-2xl text-white">Termo de responsabilidade</h1>
                <div class="mt-6 space-y-4 text-slate-200">
                    <p>
                        Eu estou ciente de que o inDROID é um jogo de perguntas e respostas, no qual quem irá responder as questões serei eu mesmo(a),
                        dando a impressão de que é a inteligência artificial que estará respondendo.
                    </p>
                    <p>
                        Todas as perguntas feitas e respondidas serão de minha responsabilidade. Estou ciente também de que as perguntas feitas no quadro
                        de questões NÃO ficarão armazenadas em nenhum banco de dados e a aplicação será isenta de qualquer responsabilidade sobre as
                        perguntas que forem efetuadas, para todo e qualquer determinado assunto.
                    </p>
                    <p>
                        Eu saliento que não irei fazer questionamento que prejudique ou irá expor meu convidado a nenhum constrangimento de qualquer natureza.
                    </p>
                    <p>Ciente disto confirmo abaixo.</p>
                </div>
                <Link href="/cadastro" class="mt-8 inline-flex rounded-full bg-emerald-400 px-6 py-3 font-bold text-ink">Estou ciente</Link>
            </div>
            <img src="/images/robot-head.jpg" alt="Robô do inDROID" class="h-full min-h-80 w-full rounded-[2rem] object-cover neon-border" />
        </div>
    </AppLayout>
</template>
