<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import FlashMessage from '../../Components/FlashMessage.vue';

const props = defineProps({
    token: String,
    email: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => form.post('/redefinir-senha');
</script>

<template>
    <Head title="Redefinir senha" />
    <AppLayout background="/images/ixtepo-think.jpg">
        <div class="mx-auto max-w-lg px-4 py-16">
            <form class="glass-card rounded-3xl p-8" @submit.prevent="submit">
                <FlashMessage title="Alterar senha" />
                <label class="mb-2 block text-sm">Nova senha</label>
                <input v-model="form.password" type="password" required class="mb-4 w-full rounded-xl border border-white/15 bg-black/30 px-4 py-3 outline-none focus:border-neon" />
                <p v-if="form.errors.password" class="mb-3 text-sm text-rose-300">{{ form.errors.password }}</p>
                <label class="mb-2 block text-sm">Confirmar nova senha</label>
                <input v-model="form.password_confirmation" type="password" required class="mb-6 w-full rounded-xl border border-white/15 bg-black/30 px-4 py-3 outline-none focus:border-neon" />
                <p v-if="form.errors.email" class="mb-3 text-sm text-rose-300">{{ form.errors.email }}</p>
                <button class="w-full rounded-full bg-neon py-3 font-bold text-ink" :disabled="form.processing">Salvar</button>
            </form>
        </div>
    </AppLayout>
</template>
