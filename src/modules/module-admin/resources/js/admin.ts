import "../../../../resources/css/app.css";
import { initializeTheme } from "@/composables/useAppearance";
import { createInertiaApp } from "@inertiajs/vue3";
import { createApp, h } from "vue";
import { ZiggyVue } from "ziggy-js";

await createInertiaApp({
    pages: "./pages",
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el!);
    },
});

initializeTheme();
