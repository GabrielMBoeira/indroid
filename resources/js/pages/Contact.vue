<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';
import FlashMessage from '../Components/FlashMessage.vue';

const form = useForm({
    email: '',
    message: '',
});

const submit = () => form.post('/contato');
</script>

<template>
    <Head title="Contato" />
    <AppLayout background="/images/ixtepo-friends.jpg">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 py-12 lg:grid-cols-2">
            <div class="overflow-hidden rounded-3xl glass-card">
                <img src="/images/ixtepo-beach.jpg" alt="Ixtepô na praia de Florianópolis" class="h-48 w-full object-cover" />
                <div class="p-6">
                    <h2 class="font-display text-xl text-white">Localização</h2>
                    <div class="mt-4 overflow-hidden rounded-2xl">
                        <iframe
                            title="Mapa de Florianópolis"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d113157.28894550656!2d-48.547653!3d-27.588405!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95273817bc3c85ad%3A0x93f9cf04bbb0cc22!2sAv.%20Trompowsky%20-%20Centro%2C%20Florian%C3%B3polis%20-%20SC%2C%2088010-400!5e0!3m2!1spt-BR!2sbr"
                            class="h-56 w-full border-0"
                            loading="lazy"
                            allowfullscreen
                        ></iframe>
                    </div>
                    <p class="mt-4 text-sm italic text-orange-100">
                        Rua: Av. Trompowsky, 354<br>
                        Bairro: Centro<br>
                        Cidade: Florianópolis<br>
                        Santa Catarina / Brasil<br>
                        E-mail: suporte@indroid.com.br
                    </p>
                </div>
            </div>

            <form class="rounded-3xl glass-card p-8" @submit.prevent="submit">
                <FlashMessage title="Contato" subtitle="Manda um recado pro Ixtepô. Retornamos assim que visualizarmos a mensagem." />
                <label class="mb-2 block text-sm">Informe seu email</label>
                <input v-model="form.email" type="email" required class="mb-4 w-full rounded-xl border border-white/15 bg-ink/40 px-4 py-3 outline-none focus:border-neon" />
                <p v-if="form.errors.email" class="mb-3 text-sm text-rose-300">{{ form.errors.email }}</p>
                <label class="mb-2 block text-sm">Mensagem</label>
                <textarea v-model="form.message" maxlength="300" required rows="4" class="mb-6 w-full rounded-xl border border-white/15 bg-ink/40 px-4 py-3 outline-none focus:border-neon"></textarea>
                <p v-if="form.errors.message" class="mb-3 text-sm text-rose-300">{{ form.errors.message }}</p>
                <button class="w-full rounded-full bg-neon py-3 font-bold text-ink" :disabled="form.processing">Enviar</button>
            </form>
        </div>
    </AppLayout>
</template>
