<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import FlashMessage from '../../Components/FlashMessage.vue';

const props = defineProps({
    users: { type: Array, default: () => [] },
    filters: { type: Object, default: () => ({ email: '', phone: '' }) },
});

const form = useForm({
    email: props.filters.email,
    phone: props.filters.phone,
});

const search = () => form.get('/admin/usuarios');
const activate = (id) => router.post(`/admin/usuarios/${id}/liberar`);
</script>

<template>
    <Head title="Usuários" />
    <AppLayout background="/images/circuit.jpg">
        <div class="mx-auto max-w-6xl px-4 py-10">
            <FlashMessage />
            <div class="mb-4 rounded-2xl bg-black/60 py-3 text-center font-display tracking-widest text-white">Liberar usuário</div>
            <form class="rounded-3xl glass-card p-6" @submit.prevent="search">
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold">E-mail</label>
                        <input v-model="form.email" class="w-full rounded-xl border border-white/15 bg-black/30 px-4 py-3 outline-none focus:border-neon" />
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Telefone</label>
                        <input v-model="form.phone" class="w-full rounded-xl border border-white/15 bg-black/30 px-4 py-3 outline-none focus:border-neon" />
                    </div>
                </div>
                <button class="mt-4 rounded-full border border-neon px-5 py-2 text-sm text-neon">Pesquisar</button>
            </form>

            <div class="mt-6 overflow-x-auto rounded-3xl glass-card">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead class="bg-black/40 text-slate-300">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Telefone</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id" class="border-t border-white/10">
                            <td class="px-4 py-3">{{ user.id }}</td>
                            <td class="px-4 py-3">{{ user.email }}</td>
                            <td class="px-4 py-3">{{ user.phone }}</td>
                            <td class="px-4 py-3">{{ user.status }}</td>
                            <td class="px-4 py-3">
                                <button class="rounded-full bg-emerald-400 px-4 py-2 text-xs font-bold text-ink" @click="activate(user.id)">
                                    Liberar e enviar email
                                </button>
                            </td>
                        </tr>
                        <tr v-if="!users.length">
                            <td colspan="5" class="px-4 py-6 text-center text-slate-400">Nenhum usuário encontrado.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex gap-3 text-sm">
                <Link href="/admin/mensagens" class="text-neon">Ver mensagens</Link>
                <Link href="/perguntar" class="text-slate-300">Perguntar</Link>
            </div>
        </div>
    </AppLayout>
</template>
