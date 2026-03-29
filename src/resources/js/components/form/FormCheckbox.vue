<script setup lang="ts">

import { InertiaForm } from "@inertiajs/vue3";
import { inject } from "vue";

defineOptions({
    inheritAttrs: false,
});

defineProps<{
    name: string;
    label: string;
    description?: string;
}>();

const form = inject<InertiaForm<any>>("form");

</script>

<template>

    <UiField orientation="horizontal">
        <UiCheckbox :id="name" v-model="form[name]" />
        <UiFieldContent>
            <UiFieldLabel :for="name" class="font-normal cursor-pointer">
                {{ label }}
            </UiFieldLabel>
            <UiFieldDescription v-if="description">
                {{ description }}
            </UiFieldDescription>
            <UiFieldDescription v-show="form.errors[name]" class="text-sm text-red-600 dark:text-red-500">
                {{ form.errors[name] }}
            </UiFieldDescription>
        </UiFieldContent>
    </UiField>

</template>