<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import FlashMessage from '../../Components/FlashMessage.vue';

defineProps({
    messages: { type: Array, default: () => [] },
});

const remove = (id) => router.delete(`/admin/mensagens/${id}`);
</script>

<template>
    <Head title="Mensagens" />
    <AppLayout background="/images/tech.jpg">
        <div class="mx-auto max-w-6xl px-4 py-10">
            <FlashMessage />
            <div class="overflow-x-auto rounded-3xl glass-card">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead class="bg-black/40 text-slate-300">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Mensagem</th>
                            <th class="px-4 py-3">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="message in messages" :key="message.id" class="border-t border-white/10">
                            <td class="px-4 py-3">{{ message.id }}</td>
                            <td class="px-4 py-3">{{ message.email }}</td>
                            <td class="max-w-md truncate px-4 py-3">{{ message.message }}</td>
                            <td class="px-4 py-3">
                                <button class="rounded-full bg-rose-500 px-4 py-2 text-xs font-bold text-white" @click="remove(message.id)">Deletar</button>
                            </td>
                        </tr>
                        <tr v-if="!messages.length">
                            <td colspan="4" class="px-4 py-6 text-center text-slate-400">Nenhuma mensagem pendente.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Link href="/admin/usuarios" class="mt-4 inline-block text-sm text-neon">Voltar para usuários</Link>
        </div>
    </AppLayout>
</template>
