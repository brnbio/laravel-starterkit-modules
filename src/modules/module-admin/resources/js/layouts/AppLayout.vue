<script setup lang="ts">

import { SidebarInset, SidebarProvider } from "@/components/ui/sidebar";
import type { BreadcrumbItemType } from "@/types";
import AppSidebar from "@admin/layouts/components/AppSidebar.vue";
import AppSidebarHeader from "@admin/layouts/components/AppSidebarHeader.vue";
import FlashMessages from "@admin/layouts/components/FlashMessages.vue";
import { Head, useLayoutProps, usePage } from "@inertiajs/vue3";

defineProps<{
    title?: string;
    breadcrumbs?: BreadcrumbItemType[];
}>();

const isOpen: boolean = usePage().props.sidebarOpen;

const layout = useLayoutProps({
    title: "",
    breadcrumbs: [],
})

</script>

<template>

    <Head :title="layout.title" />
    <SidebarProvider :default-open="isOpen">
        <AppSidebar />
        <SidebarInset class="overflow-x-hidden">
            <AppSidebarHeader :breadcrumbs="layout.breadcrumbs" />
            <main class="mx-auto w-full max-w-[1920px] px-8 pt-10 pb-20 flex flex-col gap-8">
                <slot />
            </main>
        </SidebarInset>
    </SidebarProvider>
    <FlashMessages />

</template>
