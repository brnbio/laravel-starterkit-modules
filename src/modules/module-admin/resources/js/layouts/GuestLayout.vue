<script setup lang="ts">

import { Head, Link, useLayoutProps } from "@inertiajs/vue3";
import { dashboard } from "@/wayfinder/routes/admin";
import AppLogo from "./components/AppLogo.vue";

const layout = useLayoutProps({
    title: ""
})

</script>

<template>

    <Head :title="layout.title" />
    <div class="min-h-screen flex flex-col items-center justify-center overflow-x-clip bg-background text-foreground">
        <div class="w-full max-w-md">
            <Link :href="dashboard()" class="fixed top-0 left-0 p-3">
                <AppLogo :height="30" />
            </Link>
            <slot />
        </div>
    </div>

</template>
