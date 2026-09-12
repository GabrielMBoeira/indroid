<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
</script>

<template>
    <Head title="Página não encontrada" />
    <AppLayout background="/images/ixtepo-sunset.jpg">
        <div class="mx-auto max-w-3xl px-4 py-24 text-center">
            <img src="/images/ixtepo-closeup.jpg" alt="Ixtepô perdido na ilha" class="mx-auto mb-8 h-56 w-56 rounded-full object-cover neon-border" />
            <h1 class="font-display text-4xl text-white">Página não encontrada</h1>
            <p class="mt-4 text-orange-100">Ixtepô vasculhou a lagoa e não achou esse endereço, tchê.</p>
            <Link href="/" class="mt-8 inline-flex rounded-full bg-neon px-6 py-3 font-bold text-ink">Voltar para home</Link>
        </div>
    </AppLayout>
</template>
