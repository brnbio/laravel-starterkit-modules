<script setup lang="ts">

import { Spinner } from "@/components/ui/spinner";
import { InertiaForm } from "@inertiajs/vue3";
import { inject } from "vue";

const form = inject<InertiaForm<any>>("form");

withDefaults(defineProps<{
    label?: string;
    variant?: "default" | "destructive" | "outline" | "secondary" | "ghost";
}>(), {
    label: "Speichern",
    variant: "default",
});

</script>

<template>

    <UiButton type="submit" :disabled="form.processing" :variant class="self-start">
        <Spinner v-if="form.processing" />
        {{ label }}
    </UiButton>

</template>