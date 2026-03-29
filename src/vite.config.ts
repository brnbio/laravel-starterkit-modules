import inertia from "@inertiajs/vite";
import { wayfinder } from "@laravel/vite-plugin-wayfinder";
import tailwindcss from "@tailwindcss/vite";
import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
import iconsResolver from "unplugin-icons/resolver";
import icons from "unplugin-icons/vite";
import components from "unplugin-vue-components/vite";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "modules/module-admin/resources/js/admin.ts",
                "modules/module-portal/resources/js/portal.ts"
            ],
            refresh: true,
        }),
        wayfinder({
            path: "resources/js/types/wayfinder",
            actions: false
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
        components({
            dts: "components.d.ts",
            dirs: [
                "resources/js/components",
                "modules/*/resources/js/components",
            ],
            directoryAsNamespace: true,
            collapseSamePrefixes: true,
            resolvers: [
                iconsResolver({
                    prefix: "icon",
                    enabledCollections: [ "material-symbols" ],
                }),
            ]
        }),
        icons({
            compiler: "vue3",
        })
    ],
    resolve: {
        alias: {
            "@": "/resources/js/",
            "@admin": "/modules/module-admin/resources/js/",
            "@portal": "/modules/module-portal/resources/js/",
        },
        extensions: [ ".ts", ".vue", ".js" ],
    },
});
