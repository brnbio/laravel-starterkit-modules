<script setup lang="ts">

import AppLogo from "@portal/layouts/components/AppLogo.vue";
import FlashMessages from "@portal/layouts/components/FlashMessages.vue";
import { Head, useLayoutProps } from "@inertiajs/vue3";

const layout = useLayoutProps({
    title: "",
    breadcrumbs: [],
});

</script>

<template>

    <Head :title="layout.title" />
    <header>
        <AppLogo />
    </header>
    <main>
        <slot />
    </main>
    <FlashMessages />

</template>
