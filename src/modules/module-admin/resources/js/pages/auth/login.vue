<script setup lang="ts">

import { login } from "@/types/wayfinder/routes/admin";
import { request } from "@/types/wayfinder/routes/admin/password";
import GuestLayout from "@admin/layout/GuestLayout.vue";
import { Link, setLayoutProps, useForm } from "@inertiajs/vue3";

defineOptions({
    layout: GuestLayout,
    inheritAttrs: false
});

const title = "Anmeldung";

const form = useForm("post", login.url(), {
    email: null,
    password: null,
    remember: true,
});

setLayoutProps({ title });

</script>

<template>

    <Heading :title description="Willkommen zurück! Bitte melden Sie sich an." />
    <FormProvider :form>
        <form @submit.prevent="form.submit()">
            <UiFieldGroup>
                <FormControl name="email" label="E-Mail-Adresse" type="email" autofocus required />
                <FormPassword name="password" required>
                    <template #label>
                        Passwort
                        <Link :href="request()" class="text-sm underline text-gray-500" tabindex="-1">
                            Passwort vergessen?
                        </Link>
                    </template>
                </FormPassword>
                <FormSubmit label="Anmelden" />
            </UiFieldGroup>
        </form>
    </FormProvider>

</template>
