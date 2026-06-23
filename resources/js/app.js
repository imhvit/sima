import "@fontsource-variable/inter/wght.css";
import { createSSRApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

createInertiaApp({
    title: (title) => (title ? title : "Sima"),
    resolve: (name) => {
        const pages = import.meta.glob("./pages/**/*.vue");
        return pages[`./pages/${name}.vue`]();
    },
    setup({ el, App, props, plugin }) {
        createSSRApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});
