import {computed} from "vue";
import actions from "@/manager/store/amenity/actions";

const state = {
    managerAmenities: null,
    isLoading: false,
    currentPage: 1,
};

const getters = {};

const mutations = {
    setManagerAmenities(state, payload) {
        state.managerAmenities = payload;
    },
    setLoader(state, payload) {
        state.isLoading = payload;
    },
    setCurrentPage(state, payload) {
        state.currentPage = payload;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};

export const useAmenity = (store) => {
    const currentPage = computed(() => store.state.amenityModule.currentPage);
    const amenities = computed(() => store.state.amenityModule.managerAmenities);
    const isLoading = computed(() => store.state.amenityModule.isLoading);
    const getManagerAmenities = async (page = 0) => {
        if (page > 0) {
            store.commit('amenityModule/setCurrentPage', page);
        }
        return store.dispatch("amenityModule/getManagerAmenities", {page: page || currentPage.value});
    }

    return {
        amenities,
        isLoading,
        getManagerAmenities,
    }
}
