<script setup lang="ts">

import { dashboard } from "@/types/wayfinder/routes/admin";
import FlashMessages from "@admin/layout/components/FlashMessages.vue";
import { Head, Link } from "@inertiajs/vue3";
import AppLogo from "./components/AppLogo.vue";

const layout = withDefaults(defineProps<{
    title?: string;
}>(), {
    title: "",
});

</script>

<template>

    <Head :title="layout.title" />
    <div class="min-h-screen flex flex-col items-center justify-center overflow-x-clip bg-background text-foreground">
        <div class="w-full max-w-md">
            <Link :href="dashboard()" class="fixed top-0 left-0 p-3">
                <AppLogo :height="30" />
            </Link>
            <div class="flex flex-col gap-8">
                <slot />
            </div>
        </div>
    </div>
    <FlashMessages />

</template>
