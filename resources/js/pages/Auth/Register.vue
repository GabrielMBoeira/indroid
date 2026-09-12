<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLayout from '../../Layouts/AppLayout.vue';
import FlashMessage from '../../Components/FlashMessage.vue';

const showHowTo = ref(false);
const form = useForm({
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const maskPhone = (value) => {
    const digits = value.replace(/\D/g, '').slice(0, 11);
    if (digits.length <= 10) {
        return digits.replace(/(\d{2})(\d{0,4})(\d{0,4})/, (_, a, b, c) => {
            return [a && `(${a}`, b && `) ${b}`, c && `.${c}`].filter(Boolean).join('');
        });
    }
    return digits.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2.$3');
};

const onPhone = (event) => {
    form.phone = maskPhone(event.target.value);
};

const submit = () => form.post('/cadastro');
</script>

<template>
    <Head title="Cadastrar usuário" />
    <AppLayout background="/images/ixtepo-sunset.jpg">
        <div class="mx-auto grid max-w-5xl items-center gap-10 px-4 py-10 lg:grid-cols-2">
            <div>
                <img src="/images/ixtepo-hero.jpg" alt="Ixtepô, o manezinho pescador" class="h-[280px] w-full rounded-[2rem] object-cover neon-border" />
                <p class="mt-4 text-orange-50">Cadastre-se, pague a liberação e comece a impressionar a galera da ilha. O termo deixa claro: quem responde é você.</p>
            </div>
            <form class="glass-card rounded-3xl p-8" @submit.prevent="submit">
                <FlashMessage title="Cadastrar usuário" />
                <label class="mb-2 block text-sm">Cadastre seu email</label>
                <input v-model="form.email" type="email" required class="mb-3 w-full rounded-xl border border-white/15 bg-ink/40 px-4 py-3 outline-none focus:border-neon" />
                <p v-if="form.errors.email" class="mb-3 text-sm text-rose-300">{{ form.errors.email }}</p>

                <label class="mb-2 block text-sm">Cadastre seu telefone</label>
                <input :value="form.phone" type="tel" required placeholder="(99) 99999.9999" class="mb-3 w-full rounded-xl border border-white/15 bg-ink/40 px-4 py-3 outline-none focus:border-neon" @input="onPhone" />
                <p v-if="form.errors.phone" class="mb-3 text-sm text-rose-300">{{ form.errors.phone }}</p>

                <label class="mb-2 block text-sm">Cadastre sua senha</label>
                <input v-model="form.password" type="password" required class="mb-3 w-full rounded-xl border border-white/15 bg-ink/40 px-4 py-3 outline-none focus:border-neon" />
                <p v-if="form.errors.password" class="mb-3 text-sm text-rose-300">{{ form.errors.password }}</p>

                <label class="mb-2 block text-sm">Confirme sua senha</label>
                <input v-model="form.password_confirmation" type="password" required class="mb-4 w-full rounded-xl border border-white/15 bg-ink/40 px-4 py-3 outline-none focus:border-neon" />

                <div class="mb-4 flex flex-wrap items-center justify-between gap-3 text-sm">
                    <label class="flex items-center gap-2">
                        <input v-model="form.terms" type="checkbox" required />
                        Li o termo e estou ciente
                    </label>
                    <button type="button" class="text-neon" @click="showHowTo = true">Como jogar</button>
                    <Link href="/termo" class="text-white underline">Acessar termo de responsabilidade</Link>
                </div>
                <p v-if="form.errors.terms" class="mb-3 text-sm text-rose-300">{{ form.errors.terms }}</p>
                <button class="w-full rounded-full bg-neon py-3 font-bold text-ink" :disabled="form.processing">Cadastrar</button>
            </form>
        </div>

        <div v-if="showHowTo" class="fixed inset-0 z-50 flex items-center justify-center bg-ink/70 p-4" @click.self="showHowTo = false">
            <div class="max-w-lg overflow-hidden rounded-3xl glass-card">
                <img src="/images/ixtepo-closeup.jpg" alt="Como jogar com o Ixtepô" class="h-48 w-full object-cover" />
                <div class="p-6 text-sm leading-6 text-orange-50">
                    <h3 class="mb-3 font-display text-lg text-white">Como jogar</h3>
                    <p>1) Pense em uma pergunta que irá fazer para seu amigo <strong>(uma pergunta na qual você já sabe a resposta)</strong>.</p>
                    <p class="mt-3">2) Faça login e digite a resposta! O Ixtepô gera um causo aleatório para você digitar sem que seu amigo perceba.</p>
                    <p class="mt-3">Depois aperte a tecla ponto "." para assumir o controle da pergunta e completar a frase.</p>
                    <button class="mt-5 rounded-full bg-neon px-5 py-2 font-bold text-ink" @click="showHowTo = false">Entendi, ixtepô!</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
