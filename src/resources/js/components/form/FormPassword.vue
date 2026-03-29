<script setup lang="ts">

import { InertiaForm } from "@inertiajs/vue3";
import { inject, ref } from "vue";

defineOptions({
    inheritAttrs: false,
});

defineProps<{
    name: string;
    label?: string;
    description?: string;
}>();

const form = inject<InertiaForm<any>>("form");

const passwordVisible = ref(false);

const toggle = () => {
    passwordVisible.value = !passwordVisible.value;
};

</script>

<template>

    <UiField>
        <UiFieldLabel :for="name" class="flex justify-between">
            <slot name="label">
                {{ label }}
            </slot>
        </UiFieldLabel>
        <div class="relative w-full items-center">
            <UiInput :id="name" v-bind="$attrs" v-model="form[name]" :type="passwordVisible ? 'text': 'password'" />
            <span class="absolute inset-e-0 inset-y-0 flex items-center justify-center px-2 cursor-pointer" @click="toggle">
                <IconMaterialSymbolsVisibilityOffOutline v-if="passwordVisible" :size="16" class="text-muted-foreground" />
                <IconMaterialSymbolsVisibilityOutline v-else :size="16" class="text-muted-foreground" />
            </span>
        </div>
        <UiFieldDescription v-if="description">
            {{ description }}
        </UiFieldDescription>
        <UiFieldDescription v-show="form.errors[name]" class="text-sm text-red-600 dark:text-red-500">
            {{ form.errors[name] }}
        </UiFieldDescription>
    </UiField>

</template>