<script setup lang="ts">

import { Heading } from "@/components";
import { FormControl, FormPassword, FormProvider, FormSubmit } from "@/components/forms";
import { FieldGroup } from "@/components/ui/field";
import { GuestLayout } from "@/layouts";
import { Link, useForm } from "@inertiajs/vue3";

const title = "Anmeldung";

const form = useForm({
    email: null,
    password: null,
    remember: true,
});

const submit = () => {
    form.post(route("portal.login.store"));
};

</script>

<template>

    <GuestLayout :title>
        <div class="flex flex-col gap-8">
            <Heading :title description="Willkommen zurück! Bitte melden Sie sich an." />
            <FormProvider :form>
                <form @submit.prevent="submit">
                    <FieldGroup>
                        <FormControl name="email" label="E-Mail-Adresse" type="email" autofocus required />
                        <FormPassword name="password" required>
                            <template #label>
                                Passwort
                                <Link :href="route('portal.password.request')" class="text-sm underline text-gray-500" tabindex="-1">
                                    Passwort vergessen?
                                </Link>
                            </template>
                        </FormPassword>
                        <FormSubmit label="Anmelden" />
                    </FieldGroup>
                </form>
            </FormProvider>
        </div>
    </GuestLayout>

</template>
