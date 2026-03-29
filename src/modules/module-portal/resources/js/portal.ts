import "../css/app.css";
import { createInertiaApp } from "@inertiajs/vue3";
import AppLayout from "@portal/layout/AppLayout.vue";

void createInertiaApp({
    layout: () => AppLayout,
});