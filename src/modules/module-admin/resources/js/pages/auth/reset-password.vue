<script setup lang="ts">

import { store } from "@/wayfinder/routes/admin/password";
import GuestLayout from "@admin/layouts/GuestLayout.vue";
import { setLayoutProps, useForm } from "@inertiajs/vue3";

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

defineOptions({
    layout: GuestLayout
});

setLayoutProps({
    title: title,
});

</script>

<template>

    <Heading :title />
    <FormProvider :form>
        <form @submit.prevent="form.submit()">
            <FieldSet>
                <FieldDescription>
                    Bitte geben Sie Ihr neues Passwort zweimal ein. Das Passwort muss mindestens 8 Zeichen lang sein.
                </FieldDescription>
                <FieldGroup>
                    <FormPassword name="password" label="Neues Passwort" />
                    <FormPassword name="password_confirmation" label="Neues Passwort bestätigen" />
                    <div>
                        <Button type="submit" :disabled="form.processing">
                            Passwort speichern
                            <Spinner v-if="form.processing" />
                        </Button>
                    </div>
                </FieldGroup>
            </FieldSet>
        </form>
    </FormProvider>

</template>
