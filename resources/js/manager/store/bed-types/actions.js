import httpClient from "@/manager/store/httpClient";
import {resolveError} from "@/manager/helpers";

export default {
    async getBedTypes({commit}) {
        try {
            commit("setLoader", true);
            let response = await httpClient.get('/manage/bed-types');
            commit("setBedTypes", response.data);
            commit("setLoader", false);
            return Promise.resolve(response.data);
        } catch (error) {
            commit("setLoader", false);
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async getBedTypesOptions({commit}) {
        try {
            let response = await httpClient.get('/manage/bed-types/options');
            commit("setBedTypesOptions", response.data);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async saveBedType({commit}, payload = {}) {
        try {
            let response;
            if (payload.id) {
                response = await httpClient.put('/manage/bed-types/' + payload.id, payload);
            } else {
                response = await httpClient.post('/manage/bed-types', payload);
            }
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
}
