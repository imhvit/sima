import { createInertiaApp } from "@inertiajs/vue3";
import createServer from "@inertiajs/vue3/server";
import { createSSRApp, h } from "vue";
import { renderToString } from "vue/server-renderer";

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: (name) => {
            const pages = import.meta.glob("./pages/**/*.vue");
            return pages[`./pages/${name}.vue`]();
        },
        setup({ App, props, plugin }) {
            return createSSRApp({
                render: () => h(App, props),
            }).use(plugin);
        },
    }),
);
