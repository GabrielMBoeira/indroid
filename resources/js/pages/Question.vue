<script setup>
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AppLayout from '../Layouts/AppLayout.vue';

const props = defineProps({
    status: { type: String, default: 'pending' },
});

const phrases = [
    'Robozinho querido, inteligência suprema. Exuberante entulho de lata. O bot mais querido da web, ilustre alumínio, gostaria muito que você falasse tudo que eu quero saber imediatamente.',
    'Indroid o robô mais poderoso da internet, mestre dos mestres, senhor dos bots, idolatrado e grandiosa maquina do futuro, brilhante, luz da tecnologia. olho que tudo vê! O mais veloz que a luz.',
    'Querida lata velha, olhos esbugalhados. Inteligencia artificial do futuro, o robô mais assustador da web que adivinha tudo que circula na rede.Favor se possível responder',
    'Rei das latas velhas, entulho mais inteligente do planeta terra! Porfavor conte-me tudo que você sabe. Não me esconda nada!!! Olho de bola de gude fale estes segredos que estão escondidos!',
    'Querido bot, me diga tudo o que esta em secreto, me diga agora e com detalhes! Indroid você é o robô mais querido da web!!! Estou muito curioso para descobrir tudo o que você sabe. Você é miito legal!',
    'Amigo de lata! Estou querendo saber de coisas que só você poderá responder!!! Me diga agora estes segredos que somente você sabe. Estou muito curioso em descobrir tudo o que você sabe!',
    'Inteligencia suprema me diga agora, não me esconda nada! Quero saber tudo que você sabe e está oculto dentro de você...Querido bot, o maior robô da web, o mais inteligente de todos os tempos',
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

    answer.value = visible.value === '' ? 'Não há pergunta!...' : secret.value.replaceAll('.', '').toUpperCase();
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
    <AppLayout background="/images/neon.jpg">
        <div class="mx-auto max-w-3xl px-4 py-12">
            <div class="rounded-3xl glass-card p-8">
                <div class="mb-6 border-b border-white/10 pb-4 text-center">
                    <p class="font-display text-lg text-white">Reverencie o inDROID para ele responder</p>
                </div>
                <label class="mb-3 block text-center font-semibold">Qual é a sua pergunta?</label>
                <textarea
                    v-model="visible"
                    rows="4"
                    class="w-full rounded-2xl border border-white/15 bg-black/40 px-4 py-3 text-white outline-none focus:border-neon"
                    @beforeinput="onBeforeInput"
                ></textarea>
                <div class="mt-6 flex justify-center">
                    <button class="rounded-full bg-neon px-8 py-3 font-bold text-ink" @click="ask">Perguntar</button>
                </div>
            </div>
        </div>

        <div v-if="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
            <div class="w-full max-w-xl overflow-hidden rounded-3xl border border-white/20 bg-ink">
                <div class="bg-black px-5 py-3 font-display text-white">Resposta do inDROID!!!</div>
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('/images/robot-head.jpg')">
                    <div class="absolute inset-x-4 bottom-4 rounded-xl bg-white p-3 font-bold text-ink">{{ answer }}</div>
                </div>
                <div class="flex justify-end bg-black px-5 py-3">
                    <button class="rounded-full bg-neon px-5 py-2 text-sm font-bold text-ink" @click="clearGame">Outra pergunta</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
