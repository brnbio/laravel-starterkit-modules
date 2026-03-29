<script setup lang="ts">

import { dashboard } from "@/types/wayfinder/routes/admin";
import { setLayoutProps } from "@inertiajs/vue3";

defineOptions({
    inheritAttrs: false
});

const title = "Dashboard";

setLayoutProps({
    title,
    breadcrumbs: [
        { title: title, href: dashboard() },
    ]
});

</script>

<template>

    <Heading :title />

</template>
