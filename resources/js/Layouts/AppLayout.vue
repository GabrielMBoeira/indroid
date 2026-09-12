<script setup>
import { computed } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';
const props = defineProps({
    background: { type: String, default: '/images/ixtepo-sunset.jpg' },
});

const page = usePage();
const user = computed(() => page.props.auth?.user);
const year = new Date().getFullYear();

const logout = () => router.post('/logout');
</script>

<template>
    <div class="min-h-screen flex flex-col relative overflow-hidden">
        <div class="absolute inset-0">
            <img :src="background" alt="" class="h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-b from-ink/70 via-ink/60 to-ink/90"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(244,162,97,0.22),_transparent_48%)]"></div>
        </div>

        <header class="relative z-20">
            <nav class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4">
                <Link href="/" class="flex items-center gap-3">
                    <img src="/images/ixtepo-logo.png" alt="Manezinho Ixtepô" class="h-11 w-11 rounded-full object-cover neon-border" />
                    <span class="font-display text-lg tracking-wide text-white">Manezinho Ixtepô</span>
                </Link>

                <div class="hidden items-center gap-5 text-sm font-semibold text-orange-50 md:flex">
                    <Link href="/" class="hover:text-neon">Home</Link>
                    <Link v-if="!user" href="/cadastro" class="hover:text-neon">Cadastrar</Link>
                    <Link href="/contato" class="hover:text-neon">Contato</Link>
                    <Link v-if="user" href="/perguntar" class="hover:text-neon">Perguntar</Link>
                    <Link v-if="user" href="/alterar-senha" class="hover:text-neon">Alterar senha</Link>
                    <Link v-if="user?.is_admin" href="/admin/usuarios" class="hover:text-neon">Admin</Link>
                    <Link v-if="!user" href="/login" class="rounded-full bg-neon px-4 py-2 text-ink hover:bg-amber-300">Login</Link>
                    <button v-else type="button" class="rounded-full border border-white/20 px-4 py-2 hover:border-neon" @click="logout">Sair</button>
                </div>

                <details class="relative md:hidden">
                    <summary class="cursor-pointer list-none rounded-full border border-white/20 px-4 py-2 text-sm">Menu</summary>
                    <div class="absolute right-0 mt-2 w-48 rounded-2xl glass-card p-3 text-sm">
                        <Link href="/" class="block py-2">Home</Link>
                        <Link v-if="!user" href="/cadastro" class="block py-2">Cadastrar</Link>
                        <Link href="/contato" class="block py-2">Contato</Link>
                        <Link v-if="user" href="/perguntar" class="block py-2">Perguntar</Link>
                        <Link v-if="user" href="/alterar-senha" class="block py-2">Alterar senha</Link>
                        <Link v-if="user?.is_admin" href="/admin/usuarios" class="block py-2">Admin</Link>
                        <Link v-if="!user" href="/login" class="block py-2 text-neon">Login</Link>
                        <button v-else type="button" class="block py-2 text-left" @click="logout">Sair</button>
                    </div>
                </details>
            </nav>
        </header>

        <main class="relative z-10 flex-1">
            <slot />
        </main>

        <footer class="relative z-10 border-t border-white/10 bg-ink/50 px-4 py-4 text-right text-sm text-orange-100">
            <span class="font-display italic">Manezinho Ixtepô ©</span> {{ year }} · Ilha da Magia
        </footer>
    </div>
</template>
