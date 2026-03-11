<script setup lang="ts">

import { sendResetLinkEmail, showLoginForm } from "@/wayfinder/actions/Admin/Http/Controllers/AuthController";
import GuestLayout from "@admin/layouts/GuestLayout.vue";
import { Link, setLayoutProps, useForm } from "@inertiajs/vue3";

const title = "Passwort vergessen";

const form = useForm("post", sendResetLinkEmail.url(), {
    email: null,
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
                    Bitte geben Sie Ihre E-Mail-Adresse ein. Anweisungen zum
                    Zurücksetzen Ihres Passworts werden Ihnen umgehend per E-Mail zugesandt.
                </FieldDescription>
                <FieldGroup>
                    <FormControl name="email" label="E-Mail-Adresse" type="email" required />
                    <div class="flex gap-2">
                        <Button type="submit" size="default" :disabled="form.processing" class="grow-0">
                            <Spinner v-if="form.processing" />
                            Neues Passwort anfordern
                        </Button>
                        <Button as-child variant="ghost" class="text-gray-400">
                            <Link :href="showLoginForm()" class="grow-0">
                                Zurück zum Login
                            </Link>
                        </Button>
                    </div>
                </FieldGroup>
            </FieldSet>
        </form>
    </FormProvider>

</template>
