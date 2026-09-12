<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
</script>

<template>
    <Head title="Página não encontrada" />
    <AppLayout background="/images/circuit.jpg">
        <div class="mx-auto max-w-3xl px-4 py-24 text-center">
            <img src="/images/robot-head.jpg" alt="Robô perdido" class="mx-auto mb-8 h-56 w-56 rounded-full object-cover neon-border" />
            <h1 class="font-display text-4xl text-white">Página não encontrada</h1>
            <p class="mt-4 text-slate-300">O inDROID vasculhou a rede e não encontrou este endereço.</p>
            <Link href="/" class="mt-8 inline-flex rounded-full bg-neon px-6 py-3 font-bold text-ink">Voltar para home</Link>
        </div>
    </AppLayout>
</template>
