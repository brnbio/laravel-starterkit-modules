<script setup lang="ts">

import { usePage } from "@inertiajs/vue3";

const page = usePage();

</script>

<template>

    <Heading title="Startseite" />

    {{ page.flash }}

</template>
