import "../css/app.css";
import { createInertiaApp } from "@inertiajs/vue3";
import AppLayout from "./layouts/AppLayout.vue";

await createInertiaApp({
    layout: () => AppLayout,
});
