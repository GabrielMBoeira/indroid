<script setup>
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AppLayout from '../Layouts/AppLayout.vue';

const props = defineProps({
    status: { type: String, default: 'pending' },
});

const phrases = [
    'Ixtepô manezinho querido da ilha da magia, rei das tainhas e dos causos gostosos. Me conta agora tudo que tu sabe, não esconde nada do teu amigo pescador da lagoa.',
    'Manezinho Ixtepô, o mais esperto da costa catarinense, mestre das redes e das brincadeiras. Abre esse sorriso e fala tudo o que está escondido aí nessa cabeça de pescador.',
    'Ô Ixtepô, sotaque mais gostoso do sul, olho de tainha esperta. Tu adivinha tudo que circula na ilha. Favor, se possível, responder agora mesmo com aquele jeitinho manezinho.',
    'Rei das canoas velhas, pescador mais inteligente da Ilha da Magia! Por favor conta-me tudo que você sabe. Não me esconda nada!!! Fala esses segredos que estão escondidos na praia.',
    'Querido Ixtepô, me diga tudo o que está em secreto, me diga agora e com detalhes! Tu é o manezinho mais querido da web!!! Estou muito curioso para descobrir tudo o que você sabe.',
    'Amigo da tainha! Estou querendo saber de coisas que só você poderá responder!!! Me diga agora estes segredos que somente o pescador da ilha sabe. Estou muito curioso em descobrir tudo.',
    'Inteligência da lagoa me diga agora, não me esconda nada! Quero saber tudo que você sabe e está oculto dentro de você... Querido Ixtepô, o maior manezinho da web, o mais brincalhão de todos.',
];

const phraseIndex = ref(0);
const visible = ref('');
const secret = ref('');
const locked = ref(true);
const cursor = ref(0);
const asked = ref(0);
const modalOpen = ref(false);
const answer = ref('');

const currentPhrase = computed(() => phrases[phraseIndex.value] || phrases[0]);

const onBeforeInput = (event) => {
    if (!locked.value) {
        return;
    }

    event.preventDefault();

    if (event.inputType === 'deleteContentBackward' || event.inputType === 'deleteContentForward') {
        return;
    }

    const char = event.data ?? '';

    if (char === '.') {
        locked.value = false;
        return;
    }

    if (char.length === 1) {
        secret.value += char;
        visible.value += currentPhrase.value.charAt(cursor.value) || '';
        cursor.value += 1;
    }
};

const ask = () => {
    asked.value += 1;

    if (asked.value >= 7 && props.status !== 'active') {
        window.location.href = '/';
        return;
    }

    answer.value = visible.value === '' ? 'Não há pergunta, ixtepô!...' : secret.value.replaceAll('.', '').toUpperCase();
    modalOpen.value = true;
};

const clearGame = () => {
    phraseIndex.value = phraseIndex.value >= 3 ? 0 : phraseIndex.value + 1;
    visible.value = '';
    secret.value = '';
    locked.value = true;
    cursor.value = 0;
    modalOpen.value = false;
};
</script>

<template>
    <Head title="Perguntar" />
    <AppLayout background="/images/ixtepo-beach.jpg">
        <div class="mx-auto max-w-3xl px-4 py-12">
            <div class="rounded-3xl glass-card p-8">
                <div class="mb-6 border-b border-white/10 pb-4 text-center">
                    <p class="font-display text-lg text-white">Reverencie o Ixtepô para ele responder</p>
                </div>
                <label class="mb-3 block text-center font-semibold">Qual é a sua pergunta?</label>
                <textarea
                    v-model="visible"
                    rows="4"
                    class="w-full rounded-2xl border border-white/15 bg-ink/50 px-4 py-3 text-white outline-none focus:border-neon"
                    @beforeinput="onBeforeInput"
                ></textarea>
                <div class="mt-6 flex justify-center">
                    <button class="rounded-full bg-neon px-8 py-3 font-bold text-ink" @click="ask">Perguntar</button>
                </div>
            </div>
        </div>

        <div v-if="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-ink/80 p-4">
            <div class="w-full max-w-xl overflow-hidden rounded-3xl border border-white/20 bg-ink">
                <div class="bg-panel px-5 py-3 font-display text-white">Resposta do Ixtepô!!!</div>
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('/images/ixtepo-closeup.jpg')">
                    <div class="absolute inset-x-4 bottom-4 rounded-xl bg-white p-3 font-bold text-ink">{{ answer }}</div>
                </div>
                <div class="flex justify-end bg-panel px-5 py-3">
                    <button class="rounded-full bg-neon px-5 py-2 text-sm font-bold text-ink" @click="clearGame">Outra pergunta</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
