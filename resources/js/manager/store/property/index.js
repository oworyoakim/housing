import {computed, reactive, ref} from "vue";
import actions from "@/manager/store/property/actions";

const state = {
    managerProperties: null,
    activeProperty: null,
    roomsOrServices: [],
    activeRoom: null,
    isLoading: false,
    currentPage: 1,
};

const getters = {};

const mutations = {
    setManagerProperties(state, payload) {
        state.managerProperties = payload;
    },
    setLoader(state, payload) {
        state.isLoading = payload;
    },
    setCurrentPage(state, payload) {
        state.currentPage = payload;
    },
    setActiveProperty(state, payload) {
        state.activeProperty = payload;
    },
    setRoomsOrServices(state, payload) {
        state.roomsOrServices = payload;
    },
    setActiveRoom(state, payload) {
        state.activeRoom = payload;
    },
};

const activeTab = ref('details');

export const useProperty = (store) => {
    const isLoading = computed(() => store.state.propertyModule.isLoading);
    const currentPage = reactive(store.state.propertyModule.currentPage);
    const roomsOrServices = computed(() => store.state.propertyModule.roomsOrServices);
    const property = computed(() => store.state.propertyModule.activeProperty);
    const setSnackbar = async (payload) => {
        return store.dispatch("SET_SNACKBAR", payload);
    }
    const publishProperty = async (property) => {
        try {
            let responseAction = await setSnackbar({
                title: 'Are you sure?',
                text: "You will publish this property for online viewing!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#343A40',
                cancelButtonColor: '#d3b056',
                confirmButtonText: 'Publish'
            });
            if (!responseAction.isConfirmed) {
                return;
            }
            let response = await store.dispatch("propertyModule/publishProperty", {id: property.id});
            await setSnackbar({title: "Success!", text: response, icon: 'success'});
            await store.dispatch("propertyModule/getManagerProperties", {page: currentPage});
        } catch (error) {
            console.log(error);
            await setSnackbar({title: "Error!", html: error, icon: 'error'});
        }
    };

    const unPublishProperty = async (property) => {
        try {
            let responseAction = await setSnackbar({
                title: 'Are you sure?',
                text: "You will remove this property from online viewing!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#343A40',
                cancelButtonColor: '#d3b056',
                confirmButtonText: 'Unpublish'
            });
            if (!responseAction.isConfirmed) {
                return;
            }
            let response = await store.dispatch("propertyModule/unPublishProperty", {id: property.id});
            await setSnackbar({title: "Success!", text: response, icon: 'success'});
            await store.dispatch("propertyModule/getManagerProperties", {page: currentPage});
        } catch (error) {
            console.log(error);
            await setSnackbar({title: "Error!", html: error, icon: 'error'});
        }
    };

    const publishRoom = async (room) => {
        try {
            let responseAction = await setSnackbar({
                title: 'Are you sure?',
                text: "You will publish this room for online viewing!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#343A40',
                cancelButtonColor: '#d3b056',
                confirmButtonText: 'Publish'
            });
            if (!responseAction.isConfirmed) {
                return;
            }
            let response = await store.dispatch("propertyModule/publishRoom", {
                id: room.id,
                propertyId: room.propertyId
            });
            await setSnackbar({title: "Success!", text: response, icon: 'success'});
            await store.dispatch("propertyModule/getProperty", {id: room.propertyId});
        } catch (error) {
            console.log(error);
            await setSnackbar({title: "Error!", html: error, icon: 'error'});
        }
    };

    const unPublishRoom = async (room) => {
        try {
            let responseAction = await setSnackbar({
                title: 'Are you sure?',
                text: "You will remove this room from online viewing!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#343A40',
                cancelButtonColor: '#d3b056',
                confirmButtonText: 'Unpublish'
            });
            if (!responseAction.isConfirmed) {
                return;
            }
            let response = await store.dispatch("propertyModule/unPublishRoom", {
                id: room.id,
                propertyId: room.propertyId
            });
            await setSnackbar({title: "Success!", text: response, icon: 'success'});
            await store.dispatch("propertyModule/getProperty", {id: room.propertyId});
        } catch (error) {
            console.log(error);
            await setSnackbar({title: "Error!", html: error, icon: 'error'});
        }
    };

    const previewImage = async (image) => {
        await setSnackbar({
            title: image.name,
            imageUrl: image.url,
            // imageWidth: 400,
            imageHeight: 300,
            imageAlt: 'Preview image',
            width: 600,
        });
    };

    const getProperty = async (id) => {
        return store.dispatch("propertyModule/getProperty", {id});
    };

    const getPropertyRooms = async (propertyId) => {
        return store.dispatch("propertyModule/getPropertyRoomsOrServices", {propertyId});
    };

    const getRoomForManager = async (payload) => {
        return store.dispatch("propertyModule/getRoom", payload);
    };

    const saveBed = async (payload) => {
        return store.dispatch("propertyModule/saveBed", payload);
    };

    const removeBed = async (payload) => {
        return store.dispatch("propertyModule/removeBed", payload);
    };

    const removePropertyAmenity = async (payload) => {
        return store.dispatch("propertyModule/removePropertyAmenity", payload);
    };

    const removeRoomAmenity = async (payload) => {
        return store.dispatch("propertyModule/removeRoomAmenity", payload);
    };

    return {
        isLoading,
        property,
        getProperty,
        publishProperty,
        unPublishProperty,
        publishRoom,
        unPublishRoom,
        previewImage,
        roomsOrServices,
        getPropertyRooms,
        getRoomForManager,
        setSnackbar,
        saveBed,
        removeBed,
        removePropertyAmenity,
        removeRoomAmenity,
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
