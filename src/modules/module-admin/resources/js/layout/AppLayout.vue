<script setup lang="ts">

import type { BreadcrumbItem } from "@/types";
import AppSidebar from "@admin/layout/components/AppSidebar.vue";
import AppSidebarHeader from "@admin/layout/components/AppSidebarHeader.vue";
import FlashMessages from "@admin/layout/components/FlashMessages.vue";
import { Head, usePage } from "@inertiajs/vue3";

const layout = withDefaults(defineProps<{
    title?: string;
    breadcrumbs?: BreadcrumbItem[];
}>(), {
    title: "",
    breadcrumbs: () => [],
});

const isOpen: boolean = usePage().props.sidebarOpen;

</script>

<template>

    <Head :title="layout.title" />
    <UiSidebarProvider :default-open="isOpen">
        <AppSidebar />
        <UiSidebarInset class="overflow-x-hidden">
            <AppSidebarHeader :breadcrumbs="layout.breadcrumbs" />
            <main class="mx-auto w-full max-w-480 px-8 pt-10 pb-20 flex flex-col gap-8">
                <slot />
            </main>
        </UiSidebarInset>
    </UiSidebarProvider>
    <FlashMessages />

</template>
