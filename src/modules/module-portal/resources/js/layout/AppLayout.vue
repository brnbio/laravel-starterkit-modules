<script setup lang="ts">

import { Head } from "@inertiajs/vue3";
import FlashMessages from "@portal/layout/FlashMessages.vue";

const layout = withDefaults(defineProps<{
    title?: string
}>(), {
    title: "",
});

</script>

<template>

    <Head :title="layout.title" />
    <header>
        <img src="/images/logo.svg" alt="">
    </header>
    <main>
        <slot />
    </main>
    <FlashMessages />

</template>
