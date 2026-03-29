<script setup lang="ts">

import { type NavItem } from "@/types";
import { dashboard } from "@/types/wayfinder/routes/admin";
import AppLogo from "@admin/layout/components/AppLogo.vue";
import { Link } from "@inertiajs/vue3";

const mainNavItems: NavItem[] = [
    {
        title: "Dashboard",
        href: dashboard()
    },
];

const footerNavItems: NavItem[] = [
    {
        title: "Github Repo",
        href: "https://github.com/laravel/vue-starter-kit"
    },
    {
        title: "Documentation",
        href: "https://laravel.com/docs/starter-kits#vue"
    },
];

</script>

<template>

    <UiSidebar collapsible="icon" variant="sidebar">
        <UiSidebarHeader>
            <UiSidebarMenu>
                <UiSidebarMenuItem>
                    <UiSidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </UiSidebarMenuButton>
                </UiSidebarMenuItem>
            </UiSidebarMenu>
        </UiSidebarHeader>
        <UiSidebarContent>
            <UiSidebarGroup class="px-2 py-0">
                <UiSidebarGroupLabel>Platform</UiSidebarGroupLabel>
                <UiSidebarMenu>
                    <UiSidebarMenuItem v-for="item in mainNavItems" :key="item.title">
                        <UiSidebarMenuButton as-child :tooltip="item.title">
                            <Link :href="item.href">
                                <span>
                                    {{ item.title }}
                                </span>
                            </Link>
                        </UiSidebarMenuButton>
                    </UiSidebarMenuItem>
                </UiSidebarMenu>
            </UiSidebarGroup>
        </UiSidebarContent>
        <UiSidebarFooter>
            <UiSidebarGroup class="group-data-[collapsible=icon]:p-0">
                <UiSidebarGroupContent>
                    <UiSidebarMenu>
                        <UiSidebarMenuItem v-for="item in footerNavItems" :key="item.title">
                            <UiSidebarMenuButton class="text-neutral-600 hover:text-neutral-800 dark:text-neutral-300 dark:hover:text-neutral-100" as-child>
                                <a :href="item.href" target="_blank" rel="noopener noreferrer">
                                    <span>
                                        {{ item.title }}
                                    </span>
                                </a>
                            </UiSidebarMenuButton>
                        </UiSidebarMenuItem>
                    </UiSidebarMenu>
                </UiSidebarGroupContent>
            </UiSidebarGroup>
        </UiSidebarFooter>
    </UiSidebar>
    <slot />

</template>
