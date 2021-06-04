import {computed} from "vue";
import actions from "@/manager/store/room-or-service-category/actions";
const state = {
    isLoading: false,
    roomOrServiceCategories: [],
}

const getters = {};

const mutations = {
    setLoader(state,payload){
        state.isLoading = payload;
    },
    setRoomOrServiceCategories(state,payload){
        state.roomOrServiceCategories = payload;
    },
};

export const useRoomOrServiceCategory = (store) => {
    const isLoading = computed(() => store.state.roomOrServiceCategoryModule.isLoading);
    const roomOrServiceCategories = computed(() => store.state.roomOrServiceCategoryModule.roomOrServiceCategories);

    const getRoomOrServiceCategories = async () => {
        return store.dispatch("roomOrServiceCategoryModule/getRoomOrServiceCategories");
    }
    const saveRoomOrServiceCategory = async (roomOrServiceCategory) => {
        return store.dispatch("roomOrServiceCategoryModule/saveRoomOrServiceCategory", roomOrServiceCategory);
    }
    const setSnackbar = async (payload) => {
        return store.dispatch("SET_SNACKBAR", payload);
    }

    return {
        isLoading,
        roomOrServiceCategories,
        getRoomOrServiceCategories,
        saveRoomOrServiceCategory,
        setSnackbar,
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
