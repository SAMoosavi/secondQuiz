import {createApp, h} from "vue";
import {createInertiaApp} from "@inertiajs/inertia-vue3";
import {InertiaProgress} from "@inertiajs/progress";
import {createPinia} from 'pinia'
import Vue3PersianDatetimePicker from "vue3-persian-datetime-picker";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import {color} from "@/Consts/MyConsts";

require("./bootstrap");

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({el, app, props, plugin}) {
        return createApp({render: () => h(app, props)})
            .use(plugin)
            .use(createPinia())
            .use(Vue3PersianDatetimePicker)
            .use(Toast)
            .mixin({methods: {route}})
            .mount(el);
    },
});

InertiaProgress.init({color: color});
