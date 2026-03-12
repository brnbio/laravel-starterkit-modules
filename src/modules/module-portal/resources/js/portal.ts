import "../css/app.css";
import { createInertiaApp } from "@inertiajs/vue3";
import AppLayout from "@portal/layouts/AppLayout.vue";

void createInertiaApp({
    layout: () => AppLayout,
});