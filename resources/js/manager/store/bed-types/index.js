import {computed} from "vue";
import actions from "@/manager/store/bed-types/actions";

export const useBedTypes = (store) => {
    const isLoading = computed(() => store.state.bedTypesModule.isLoading);
    const bedTypes = computed(() => store.state.bedTypesModule.bedTypes);
    const bedTypesOptions = computed(() => store.state.bedTypesModule.bedTypesOptions);

    const getBedTypes = async () => {
        return store.dispatch("bedTypesModule/getBedTypes");
    }

    const getBedTypesOptions = async () => {
        return store.dispatch("bedTypesModule/getBedTypesOptions");
    }

    const saveBedType = async (bedType) => {
        return store.dispatch("bedTypesModule/saveBedType", bedType);
    }

    const setSnackbar = async (payload) => {
        return store.dispatch("SET_SNACKBAR", payload);
    }

    return {
        isLoading,
        bedTypes,
        getBedTypes,
        saveBedType,
        setSnackbar,
        bedTypesOptions,
        getBedTypesOptions,
    }
}


const state = {
    bedTypes: [],
    bedTypesOptions: [],
    isLoading: false,
};

const getters = {};

const mutations = {
    setLoader(state, payload) {
        state.isLoading = payload;
    },
    setBedTypes(state, payload) {
        state.bedTypes = payload || [];
    },
    setBedTypesOptions(state, payload) {
        state.bedTypesOptions = payload || [];
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
