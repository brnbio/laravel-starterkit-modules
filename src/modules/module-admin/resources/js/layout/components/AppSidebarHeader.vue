<script setup lang="ts">

import { useInitials } from "@/composables/useInitials";
import { BreadcrumbItem } from "@/types";
import { logout } from "@/types/wayfinder/routes/admin";
import Breadcrumbs from "@admin/layout/components/Breadcrumbs.vue";
import { Link, usePage } from "@inertiajs/vue3";

defineProps<{
    breadcrumbs: BreadcrumbItem[];
}>();

const page = usePage();

const user = page.props.user;

const { getInitials } = useInitials();

</script>

<template>

    <header class="flex h-16 shrink-0 items-center justify-between gap-2 border-b border-sidebar-border/70 px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4">
        <div class="flex items-center gap-2">
            <UiSidebarTrigger class="-ml-1" />
            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>
        <UiDropdownMenu :modal="false">
            <UiDropdownMenuTrigger as-child>
                <UiButton variant="ghost" size="icon" class="group cursor-pointer aspect-square">
                    <UiAvatar class="h-8 w-8 rounded-lg">
                        <UiAvatarImage v-if="user.avatar" :src="user.avatar" :alt="user.name" />
                        <UiAvatarFallback class="rounded-lg">
                            {{ getInitials(user.name) }}
                        </UiAvatarFallback>
                    </UiAvatar>
                </UiButton>
            </UiDropdownMenuTrigger>
            <UiDropdownMenuContent class="min-w-56" align="end" :side-offset="5" :align-offset="0">
                <UiDropdownMenuGroup>
                    <UiDropdownMenuLabel class="flex flex-col text-sm">
                        <span class="truncate font-semibold">
                            {{ user.name }}
                        </span>
                        <span class="truncate text-xs text-muted-foreground">
                            {{ user.email }}
                        </span>
                    </UiDropdownMenuLabel>
                    <UiDropdownMenuSeparator />
                    <UiDropdownMenuItem as-child>
                        <Link :href="logout()" method="post" class="flex w-full items-center gap-2">
                            <IconMaterialSymbolsLogout />
                            Logout
                        </Link>
                    </UiDropdownMenuItem>
                </UiDropdownMenuGroup>
            </UiDropdownMenuContent>
        </UiDropdownMenu>
    </header>

</template>
