require('./bootstrap');

// Import modules...

import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';

import PortalVue from 'portal-vue';
import Vue from 'vue';
import VueJSModal from 'vue-js-modal';
import store from './store';
import { ClientTable, ServerTable } from 'vue-tables-2-premium';

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);
Vue.use(VueJSModal);
Vue.use(ClientTable, {}, false, 'tailwind');

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
    store,
}).$mount(app);

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
Vue.prototype.$currentDate = document.querySelector("meta[name='current-date']").getAttribute('content');
Vue.prototype.$currentDateFull = document.querySelector("meta[name='current-date-full']").getAttribute('content');
