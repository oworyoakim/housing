import httpClient from "@/manager/store/httpClient";
import {resolveError} from "@/manager/helpers";

export default {
    async getRoomOrServiceCategories({commit}){
        try {
            commit("setLoader", true);
            let response = await httpClient.get('/manage/room-or-service-categories');
            commit("setRoomOrServiceCategories", response.data);
            commit("setLoader", false);
            return Promise.resolve(response.data);
        } catch (error) {
            commit("setLoader", false);
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async saveRoomOrServiceCategory({commit}, payload){
        try {
            let response;
            if (payload.id) {
                response = await httpClient.put('/manage/room-or-service-categories/' + payload.id, payload);
            } else {
                response = await httpClient.post('/manage/room-or-service-categories', payload);
            }
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
}
