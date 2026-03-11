import inertia from "@inertiajs/vite";
import tailwindcss from "@tailwindcss/vite";
import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "modules/module-admin/resources/js/admin.ts",
                "modules/module-portal/resources/js/portal.ts",
            ],
            refresh: true,
        }),
        tailwindcss(),
        inertia(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            "@": "/resources/js/",
            "@admin": "/modules/module-admin/resources/js/",
            "@portal": "/modules/module-portal/resources/js/",
        },
        extensions: [".ts", ".vue", ".js"],
    },
});
