<script setup lang="ts">

import { InertiaForm } from "@inertiajs/vue3";
import { inject } from "vue";

defineOptions({
    inheritAttrs: false,
});

defineProps<{
    name: string;
    label?: string;
    placeholder?: string;
    description?: string;
}>();

const form = inject<InertiaForm<any>>("form");

</script>

<template>

    <UiField>
        <UiFieldLabel v-if="label" :for="name">
            {{ label }}
        </UiFieldLabel>
        <UiInput :id="name" v-bind="$attrs" v-model="form[name]" :placeholder="placeholder" />
        <UiFieldDescription v-if="description">
            {{ description }}
        </UiFieldDescription>
        <UiFieldDescription v-show="form.errors[name]" class="text-sm text-red-600 dark:text-red-500">
            {{ form.errors[name] }}
        </UiFieldDescription>
    </UiField>

</template>