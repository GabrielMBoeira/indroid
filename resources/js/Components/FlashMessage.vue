<script setup>
defineProps({
    title: { type: String, default: '' },
    subtitle: { type: String, default: '' },
});
</script>

<template>
    <div v-if="$page.props.flash?.success || $page.props.flash?.error || $page.props.errors?.email" class="mx-auto mb-4 max-w-xl px-4">
        <div v-if="$page.props.flash?.success" class="rounded-xl border border-emerald-400/40 bg-emerald-500/15 px-4 py-3 text-sm text-emerald-100">
            {{ $page.props.flash.success }}
        </div>
        <div v-if="$page.props.flash?.error" class="rounded-xl border border-rose-400/40 bg-rose-500/15 px-4 py-3 text-sm text-rose-100">
            {{ $page.props.flash.error }}
        </div>
    </div>
    <div v-if="title" class="mb-4 text-center">
        <h2 class="font-display text-xl text-white">{{ title }}</h2>
        <p v-if="subtitle" class="mt-1 text-sm text-slate-300">{{ subtitle }}</p>
    </div>
</template>
