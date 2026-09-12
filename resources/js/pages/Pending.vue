<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';
import FlashMessage from '../Components/FlashMessage.vue';

const page = usePage();
</script>

<template>
    <Head title="Aguardando pagamento" />
    <AppLayout background="/images/ai.jpg">
        <div class="mx-auto grid max-w-5xl items-center gap-8 px-4 py-12 lg:grid-cols-2">
            <img src="/images/robot-lab.jpg" alt="Robô aguardando ativação" class="h-[360px] w-full rounded-[2rem] object-cover neon-border" />
            <div class="rounded-3xl glass-card p-8">
                <FlashMessage title="Cadastro efetuado com sucesso | Aguardando pagamento" />
                <p class="text-slate-200">
                    Para concluir o cadastro é necessário efetuar o pagamento através do Mercado Pago.
                    O <strong>inDROID</strong> é um jogo de perguntas e respostas bem divertido, em que o espectador fica impressionado com o robô adivinhando todas as questões.
                </p>
                <a :href="page.props.app.paymentLink" target="_blank" rel="noreferrer" class="mt-6 flex justify-center" title="Pagar com Mercado Pago">
                    <img src="/images/mercado-pago.svg" alt="Pague com Mercado Pago — é rápido, grátis e seguro!" class="h-16 w-auto" />
                </a>
                <p class="mt-4 text-center text-xs text-slate-400">A segurança do Mercado Pago inclui certificação PCI.</p>
                <div class="mt-6 text-sm text-slate-300">
                    <p class="underline">Liberação de cadastro</p>
                    <p>Pagamento com pix será liberado em instantes.</p>
                    <p>Pagamento com cartão ou boleto: 03 (três) dias úteis.</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
