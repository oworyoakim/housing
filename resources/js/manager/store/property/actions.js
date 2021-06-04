import {createFormDataFromPayload, prepareQueryParams, resolveError} from "../../helpers";
import httpClient from "@/manager/store/httpClient";

export default {
    async getManagerProperties({commit}, payload = {}) {
        try {
            let params = prepareQueryParams(payload);
            commit('setLoader', true);
            let response = await httpClient.get('/manage/properties' + params);
            commit("setManagerProperties", response.data);
            commit('setLoader', false);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async saveProperty({commit}, payload = {}) {
        try {
            let formData = createFormDataFromPayload(payload);
            let options = {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            };
            let response;
            if (payload.id) {
                response = await httpClient.post('/manage/properties/' + payload.id, formData, options);
            } else {
                response = await httpClient.post('/manage/properties', formData, options);
            }
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async getPropertyForUpdate({commit}, payload = {}) {
        try {
            if (!payload.id) {
                throw new Error("Property ID required!");
            }
            commit('setLoader', true);
            let response = await httpClient.get('/manage/properties/'+ payload.id + '/for-update');
            commit('setLoader', false);
            return Promise.resolve(response.data);
        } catch (error) {
            commit('setLoader', false);
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async getProperty({commit}, payload = {}) {
        try {
            if (!payload.id) {
                throw new Error("Property ID required!");
            }
            commit('setLoader', true);
            let response = await httpClient.get('/manage/properties/' + payload.id);
            commit('setActiveProperty', response.data);
            commit('setLoader', false);
            return Promise.resolve(response.data);
        } catch (error) {
            commit('setLoader', false);
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async getPropertyRoomsOrServices({commit}, payload = {}) {
        try {
            if (!payload.propertyId) {
                throw new Error("Property ID required!");
            }
            commit('setLoader', true);
            let response = await httpClient.get('/manage/properties/' + payload.propertyId + '/rooms-or-services');
            commit('setRoomsOrServices', response.data);
            commit('setLoader', false);
            return Promise.resolve(response.data);
        } catch (error) {
            commit('setLoader', false);
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async getRoom({commit}, payload = {}) {
        try {
            if (!payload.propertyId) {
                throw new Error("Property ID required!");
            }
            if (!payload.id) {
                throw new Error("Room ID required!");
            }
            // commit('setLoader', true);
            let response = await httpClient.get('/manage/rooms/' + payload.id + '?propertyId=' + payload.propertyId);
            commit('setActiveRoom', response.data);
            // commit('setLoader', false);
            return Promise.resolve(response.data);
        } catch (error) {
            // commit('setLoader', false);
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async publishProperty({commit, dispatch}, payload = {}) {
        try {
            if (!payload.id) {
                throw new Error("Property ID required!");
            }
            let response = await httpClient.patch('/manage/properties/publish/' + payload.id);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async unPublishProperty({commit}, payload = {}) {
        try {
            if (!payload.id) {
                throw new Error("Property ID required!");
            }
            let response = await httpClient.patch('/manage/properties/unpublish/' + payload.id);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async getRoomForUpdate({commit}, payload = {}) {
        try {
            if (!payload.id) {
                throw new Error("Room ID required!");
            }
            if (!payload.propertyId) {
                throw new Error("Property ID required!");
            }
            let params = prepareQueryParams(payload);
            commit('setLoader', true);
            let response = await httpClient.get('/manage/rooms/' + payload.id +'/for-update?propertyId=' + payload.propertyId);
            commit('setLoader', false);
            return Promise.resolve(response.data);
        } catch (error) {
            commit('setLoader', false);
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async saveRoom({commit}, payload = {}) {
        try {
            let formData = createFormDataFromPayload(payload);
            let options = {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            };
            let response;
            if (payload.id) {
                response = await httpClient.post('/manage/rooms/' + payload.id, formData, options);
            } else {
                response = await httpClient.post('/manage/rooms', formData, options);
            }
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async publishRoom({commit, dispatch}, payload = {}) {
        try {
            if (!payload.id) {
                throw new Error("Room ID required!");
            }
            let response = await httpClient.patch('/manage/rooms/publish/' + payload.id, payload);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async unPublishRoom({commit}, payload = {}) {
        try {
            if (!payload.id) {
                throw new Error("Room ID required!");
            }
            let response = await httpClient.patch('/manage/rooms/unpublish/' + payload.id, payload);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async uploadPropertyAdditionalPhotos({commit}, payload = {}) {
        try {
            if (!payload.id) {
                throw new Error("Property ID required!");
            }
            let response = await httpClient.post('/manage/properties/' + payload.id +'/additional-photos', payload.formData);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async uploadRoomAdditionalPhotos({commit}, payload = {}) {
        try {
            if (!payload.id) {
                throw new Error("Room ID required!");
            }
            let response = await httpClient.post('/manage/rooms/' + payload.id +'/additional-photos', payload.formData);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async saveBed({commit}, payload = {}) {
        try {
            if(!payload.roomId){
                throw new Error("Room ID is required!");
            }
            if(!payload.bedTypeId){
                throw new Error("Bed type is required!");
            }
            if(!payload.numberOfBeds || payload.numberOfBeds <= 0){
                throw new Error("Number of beds must be >= 1");
            }
            let response = await httpClient.post('/manage/beds', payload);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async removeBed({commit}, payload = {}) {
        try {
            if(!payload.roomId){
                throw new Error("Room ID is required!");
            }
            if(!payload.bedTypeId){
                throw new Error("Bed type is required!");
            }
            let response = await httpClient.patch('/manage/beds', payload);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },

    async removePropertyAmenity({commit}, payload = {}) {
        try {
            if(!payload.propertyId){
                throw new Error("Property ID is required!");
            }
            if(!payload.amenityId){
                throw new Error("Amenity ID is required!");
            }
            let response = await httpClient.patch('/manage/properties/remove-amenity', payload);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },

    async removeRoomAmenity({commit}, payload = {}) {
        try {
            if(!payload.roomId){
                throw new Error("Room ID is required!");
            }
            if(!payload.amenityId){
                throw new Error("Amenity ID is required!");
            }
            let response = await httpClient.patch('/manage/rooms/remove-amenity', payload);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
};
