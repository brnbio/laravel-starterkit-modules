<script setup lang="ts">

import { Link, setLayoutProps, useForm } from "@inertiajs/vue3";

const title = "Anmeldung";

const form = useForm("post", route("admin.login"), {
    username: null,
    password: null,
    remember: true,
});

setLayoutProps({
    title: title,
});

</script>

<template>
    <Heading :title description="Willkommen zurück! Bitte melden Sie sich an." />
    <FormProvider :form>
        <form @submit.prevent="form.submit()">
            <FieldGroup>
                <FormControl name="username" label="Benutzername" autofocus required />
                <FormPassword name="password" required>
                    <template #label>
                        Passwort
                        <Link :href="route('admin.password.request')" class="text-sm underline text-gray-500" tabindex="-1"> Passwort vergessen?</Link>
                    </template>
                </FormPassword>
                <FormSubmit label="Anmelden" />
            </FieldGroup>
        </form>
    </FormProvider>
</template>
