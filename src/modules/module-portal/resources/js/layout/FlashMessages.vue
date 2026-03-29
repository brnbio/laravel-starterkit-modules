<script setup lang="ts">

import "vue-sonner/style.css";
import { usePage } from "@inertiajs/vue3";
import { onMounted, watch } from "vue";
import { toast, Toaster } from "vue-sonner";

interface FlashMessage {
    level: "success" | "info" | "warning" | "error";
    message: string;
}

const page = usePage();

const showFlashMessages = (messages: FlashMessage[] | null | undefined) => {
    messages?.forEach((message) => {
        if (message.level === "success") {
            toast.success("Erfolgreich", { description: message.message });
            return;
        }
        if (message.level === "error") {
            toast.error("Fehler", { description: message.message });
            return;
        }
        if (message.level === "warning") {
            toast.warning("Achtung", { description: message.message });
            return;
        }
        if (message.level === "info") {
            toast.info("Info", { description: message.message });
            return;
        }

        return toast.message(message.message);
    });
};

onMounted(() => {
    showFlashMessages(page.flash.flash_notification as FlashMessage[]);
});

watch(
    () => page.flash.flash_notification,
    (messages) => showFlashMessages(messages as FlashMessage[]),
);

</script>

<template>

    <Toaster rich-colors :expand="true" position="bottom-right" />

</template>