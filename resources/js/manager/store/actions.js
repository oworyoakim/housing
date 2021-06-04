import httpClient from "@/manager/store/httpClient";
const SweetAlert = require("admin-lte/plugins/sweetalert2/sweetalert2.min");
import {resolveError} from "@/manager/helpers";

export default {
    async SET_SNACKBAR({commit}, payload = {}) {
        return SweetAlert.fire(payload);
    },
    async LOGOUT({commit}) {
        try {
            let response = await httpClient.post('/logout', {});
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async GET_USER_DATA({commit}) {
        try {
            let response = await httpClient.get('/user-data');
            commit("SET_USER_DATA", response.data);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    },
    async GET_FORM_OPTIONS({commit}, payload) {
        try {
            let response = await httpClient.get('/form-options?options=' + payload || 'all');
            commit("SET_FORM_OPTIONS", response.data);
            return Promise.resolve(response.data);
        } catch (error) {
            let message = resolveError(error);
            return Promise.reject(message);
        }
    }
}
