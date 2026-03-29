<script setup lang="ts">

import { login } from "@/types/wayfinder/routes/admin";
import { email as sendResetLinkEmail } from "@/types/wayfinder/routes/admin/password";
import GuestLayout from "@admin/layout/GuestLayout.vue";
import { Link, setLayoutProps, useForm } from "@inertiajs/vue3";

defineOptions({
    layout: GuestLayout,
    inheritAttrs: false
});

const title = "Passwort vergessen";

const form = useForm("post", sendResetLinkEmail.url(), {
    email: null,
});

setLayoutProps({
    title: title,
});

</script>

<template>

    <Heading :title />
    <FormProvider :form>
        <form @submit.prevent="form.submit({ onSuccess: () => { form.resetAndClearErrors() }})">
            <UiFieldSet>
                <UiFieldDescription>
                    Bitte geben Sie Ihre E-Mail-Adresse ein. Anweisungen zum
                    Zurücksetzen Ihres Passworts werden Ihnen umgehend per E-Mail zugesandt.
                </UiFieldDescription>
                <UiFieldGroup>
                    <FormControl name="email" label="E-Mail-Adresse" type="email" required />
                    <div class="flex gap-2">
                        <UiButton type="submit" size="default" :disabled="form.processing" class="grow-0">
                            <UiSpinner v-if="form.processing" />
                            Neues Passwort anfordern
                        </UiButton>
                        <UiButton as-child variant="ghost" class="text-gray-400">
                            <Link :href="login()" class="grow-0">
                                Zurück zum Login
                            </Link>
                        </UiButton>
                    </div>
                </UiFieldGroup>
            </UiFieldSet>
        </form>
    </FormProvider>

</template>
