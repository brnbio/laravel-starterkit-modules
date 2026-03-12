<script setup lang="ts">

import { BreadcrumbItem } from "@/types";
import { dashboard } from "@/wayfinder/routes/admin";
import { setLayoutProps } from "@inertiajs/vue3";

const title = "Dashboard";

const breadcrumbs: BreadcrumbItem[] = [
    { title: title, href: dashboard() },
];

setLayoutProps({ title: title, breadcrumbs: breadcrumbs });

</script>

<template>

    <Heading :title />

</template>
