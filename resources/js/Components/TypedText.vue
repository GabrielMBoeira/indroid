<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';

const props = defineProps({
    items: {
        type: Array,
        default: () => [
            'Ixtepô, tchê!',
            'O manezinho mais esperto da ilha',
            'Surpreenda a galera',
            'Pesca a resposta na hora',
        ],
    },
});

const text = ref('');
let phraseIndex = 0;
let charIndex = 0;
let deleting = false;
let timer;

const tick = () => {
    const current = props.items[phraseIndex];

    if (!deleting) {
        text.value = current.slice(0, charIndex + 1);
        charIndex += 1;
        if (charIndex === current.length) {
            deleting = true;
            timer = setTimeout(tick, 1100);
            return;
        }
    } else {
        text.value = current.slice(0, charIndex - 1);
        charIndex -= 1;
        if (charIndex === 0) {
            deleting = false;
            phraseIndex = (phraseIndex + 1) % props.items.length;
        }
    }

    timer = setTimeout(tick, deleting ? 30 : 80);
};

onMounted(() => {
    tick();
});

onBeforeUnmount(() => clearTimeout(timer));
</script>

<template>
    <span class="font-display text-neon">{{ text }}<span class="animate-pulse">|</span></span>
</template>
