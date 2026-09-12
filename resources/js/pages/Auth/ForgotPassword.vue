<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import FlashMessage from '../../Components/FlashMessage.vue';

const form = useForm({ email: '' });
const submit = () => form.post('/esqueci-senha');
</script>

<template>
    <Head title="Recuperar senha" />
    <AppLayout background="/images/ixtepo-beach.jpg">
        <div class="mx-auto max-w-lg px-4 py-16">
            <form class="glass-card rounded-3xl p-8" @submit.prevent="submit">
                <FlashMessage title="Recuperação de senha" subtitle="Informe o e-mail cadastrado para receber o link." />
                <label class="mb-2 block text-sm">E-mail</label>
                <input v-model="form.email" type="email" required class="mb-4 w-full rounded-xl border border-white/15 bg-black/30 px-4 py-3 outline-none focus:border-neon" />
                <p v-if="form.errors.email" class="mb-3 text-sm text-rose-300">{{ form.errors.email }}</p>
                <div class="flex items-center justify-between">
                    <Link href="/login" class="text-sm text-neon">Voltar ao login</Link>
                    <button class="rounded-full bg-neon px-5 py-2 font-bold text-ink" :disabled="form.processing">Enviar solicitação</button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
