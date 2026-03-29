<script setup lang="ts">

import { store } from "@/types/wayfinder/routes/admin/password";
import GuestLayout from "@admin/layout/GuestLayout.vue";
import { setLayoutProps, useForm } from "@inertiajs/vue3";

defineOptions({
    layout: GuestLayout,
    inheritAttrs: false
});

const props = defineProps<{
    email: string;
    token: string;
}>();

const title = "Neues Passwort erstellen";

const form = useForm("post", store.url(), {
    email: props.email,
    token: props.token,
    password: null,
    password_confirmation: null,
});

setLayoutProps({ title });

</script>

<template>

    <Heading :title />
    <FormProvider :form>
        <form @submit.prevent="form.submit({ onError: () => { form.reset() }})">
            <UiFieldSet>
                <UiFieldDescription>
                    Bitte geben Sie Ihr neues Passwort zweimal ein. Das Passwort muss mindestens 8 Zeichen lang sein.
                </UiFieldDescription>
                <UiFieldGroup>
                    <FormPassword name="password" label="Neues Passwort" />
                    <FormPassword name="password_confirmation" label="Neues Passwort bestätigen" />
                    <div>
                        <UiButton type="submit" :disabled="form.processing">
                            Passwort speichern
                            <UiSpinner v-if="form.processing" />
                        </UiButton>
                    </div>
                </UiFieldGroup>
            </UiFieldSet>
        </form>
    </FormProvider>

</template>
