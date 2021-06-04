import {prepareQueryParams, resolveError} from "@/manager/helpers";
import httpClient from "@/manager/store/httpClient";

export default {
    async getManagerAmenities({commit}, payload = {}) {
        try {
            let params = prepareQueryParams(payload);
            commit('setLoader', true);
            let response = await httpClient.get('/manage/amenities' + params);
            commit("setManagerAmenities", response.data);
            commit('setLoader', false);
            return Promise.resolve(response.data);
        } catch (error) {
            commit('setLoader', false);
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async saveAmenity({commit}, payload = {}) {
        try {
            let response;
            if (payload.id) {
                response = await httpClient.put('/manage/amenities/' + payload.id, payload);
            } else {
                response = await httpClient.post('/manage/amenities', payload);
            }
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async getAmenity({commit}, payload = {}) {
        try {
            if (!payload.id) {
                throw new Error("Amenity ID required!");
            }
            commit('setLoader', true);
            let response = await httpClient.get('/manage/amenities/show?id=' + payload.id);
            commit('setLoader', false);
            return Promise.resolve(response.data);
        } catch (error) {
            commit('setLoader', false);
            let message = resolveError(error);
            return Promise.reject(message);
        }
    }
};
