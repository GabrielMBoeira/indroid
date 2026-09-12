<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import FlashMessage from '../../Components/FlashMessage.vue';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => form.post('/login');
</script>

<template>
    <Head title="Login" />
    <AppLayout background="/images/ixtepo-beach.jpg">
        <div class="mx-auto grid max-w-5xl items-center gap-10 px-4 py-12 lg:grid-cols-2">
            <img src="/images/ixtepo-hero.jpg" alt="Ixtepô pronto para o jogo" class="hidden h-[420px] w-full rounded-[2rem] object-cover neon-border lg:block" />
            <form class="glass-card rounded-3xl p-8" @submit.prevent="submit">
                <FlashMessage title="Entrar no Manezinho Ixtepô" subtitle="Use seu e-mail e senha para conversar com o pescador da ilha." />
                <label class="mb-2 block text-sm text-orange-50">E-mail</label>
                <input v-model="form.email" type="email" required class="mb-4 w-full rounded-xl border border-white/15 bg-ink/40 px-4 py-3 outline-none focus:border-neon" />
                <p v-if="form.errors.email" class="mb-3 text-sm text-rose-300">{{ form.errors.email }}</p>
                <label class="mb-2 block text-sm text-orange-50">Senha</label>
                <input v-model="form.password" type="password" required class="mb-6 w-full rounded-xl border border-white/15 bg-ink/40 px-4 py-3 outline-none focus:border-neon" />
                <div class="flex items-center justify-between gap-3">
                    <Link href="/esqueci-senha" class="text-sm text-neon hover:underline">Esqueci a senha</Link>
                    <button class="rounded-full bg-neon px-5 py-2 text-sm font-bold text-ink" :disabled="form.processing">Entrar</button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
