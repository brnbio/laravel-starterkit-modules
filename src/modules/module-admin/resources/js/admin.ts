import "../css/app.css";
import { createInertiaApp } from "@inertiajs/vue3";
import AppLayout from "./layout/AppLayout.vue";

await createInertiaApp({
    layout: () => AppLayout,
});
