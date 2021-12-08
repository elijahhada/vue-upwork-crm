import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        ModalJobSwitched: false,
        GlobalCalendarSwitched: true,
        GlobalCalendarUpdate: false,
        DealData: Object,
        PipedriveInfo: Object,
    },
    getters: {}
});
