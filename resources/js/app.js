require("./bootstrap");

// Import modules...
import Vue from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin
} from "@inertiajs/inertia-vue";
import PortalVue from "portal-vue";
import VueJSModal from "vue-js-modal";
import store from "./store";

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);
Vue.use(VueJSModal);

const app = document.getElementById("app");

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        }),
    store
}).$mount(app);

Vue.prototype.$userId = document
    .querySelector("meta[name='user-id']")
    .getAttribute("content");
Vue.prototype.$currentDate = document
    .querySelector("meta[name='current-date']")
    .getAttribute("content");
Vue.prototype.$currentDateFull = document
    .querySelector("meta[name='current-date-full']")
    .getAttribute("content");
