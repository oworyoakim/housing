import {createStore} from "vuex";
import actions from "@/manager/store/actions";
import propertyModule from "@/manager/store/property/index";
import amenityModule from "@/manager/store/amenity/index";
import bedTypesModule from "@/manager/store/bed-types/index";
import roomOrServiceCategoryModule from "@/manager/store/room-or-service-category/index";

const state = {
    user: null,
    formOptions: {
        amenities: [],
        countries: [],
        cities: [],
        bedTypes: [],
        roomCategories: [],
        ratePeriods: [],
    },
};

const getters = {};

const mutations = {
    SET_USER_DATA(state, payload) {
        state.user = payload || null;
    },
    SET_FORM_OPTIONS(state, payload) {
        state.formOptions = payload;
    },
    TOGGLE_MODAL_OPEN_BODY_CLASS(state, isOpen) {
        let body = document.body;
        if (!!isOpen) {
            body.classList.add("modal-open");
        } else {
            body.classList.remove("modal-open");
        }
    },
};

export default createStore({
    state,
    getters,
    mutations,
    actions,
    modules: {
        amenityModule,
        bedTypesModule,
        roomOrServiceCategoryModule,
        propertyModule,
    },
    devtools: process.env.NODE_ENV !== 'production'
});
