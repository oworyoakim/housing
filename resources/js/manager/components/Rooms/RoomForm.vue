<template>
    <div class="mt-2">
        <template v-if="isLoading">
            <span class="fa fa-spinner fa-spin"></span>
        </template>
        <template v-else>
            <div class="card">
                <div class="card-header bg-gradient-secondary">
                    <h3 class="card-title"><span class="text-bold">*</span> means required</h3>
                    <div class="card-tools">
                        <router-link v-if="$route.params.propertyId && $route.params.id" :to="{name: 'manager-properties-rooms-details', params: {propertyId: $route.params.propertyId, id: $route.params.id}}" class="btn btn-info btn-sm mr-2"><i
                            class="fa fa-cog"></i>
                            Room Details
                        </router-link>
                        <router-link :to="{name: 'manager-properties-rooms-or-services', params: {id: $route.params.propertyId}}"
                                     class="btn btn-dark btn-sm"><i class="fa fa-backward"></i> Back To Property
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name<span class="text-red">*</span></label>
                                <input type="text" v-model="room.name" class="form-control"
                                       placeholder="Name of this room" required>
                            </div>
                            <div class="form-group">
                                <label>Room category</label>
                                <select v-model="room.categoryId" class="form-control select2" style="width: 100%;">
                                    <option value="">The room category</option>
                                    <option v-for="roomCategory in roomCategories" :value="roomCategory.id">
                                        {{ roomCategory.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Rate<span class="text-red">*</span></label>
                                <input type="number" v-model="room.rate" class="form-control"
                                       placeholder="How much is it?" min="0" required>
                            </div>
                            <div class="form-group">
                                <label>Rate Period<span class="text-red">*</span></label>
                                <select v-model="room.ratePeriod" class="form-control">
                                    <option value="">Rate applies per?</option>
                                    <option v-for="ratePeriod in ratePeriods" :value="ratePeriod.value">
                                        {{ ratePeriod.label }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>How many available?<span class="text-red">*</span></label>
                                <input type="number" v-model="room.frequency" class="form-control"
                                       placeholder="How many available?" min="1" required>
                            </div>
                            <div class="form-group">
                                <label>How many bathrooms?<span class="text-red">*</span></label>
                                <input type="number" v-model="room.bathrooms" class="form-control"
                                       placeholder="How many bathrooms?" min="1" required>
                            </div>
                            <div class="form-group">
                                <label>Tax rate in %age?</label>
                                <input type="number" v-model="room.tax" class="form-control"
                                       placeholder="How many available?" min="0" max="100">
                            </div>
                            <div class="form-group">
                                <label>Featured Photo</label>
                                <input type="file" @change="handleFileChange($event.target.files)"
                                       class="form-control pt-3 pb-5"
                                       accept="image/*">
                                <div class="mt-2" v-if="imageUrl">
                                    <img :src="imageUrl" class="img-thumbnail" width="200" height="200">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <SummernoteEditor
                                    placeholder="Some eye catching description of this property"
                                    v-model="room.description"
                                />
                            </div>
                            <div class="form-group">
                                <h6 class="text-bold">Amenities (select all that apply)</h6>
                                <div class="d-flex flex-wrap justify-content-between">
                                    <template v-for="amenity in amenities">
                                        <div class="form-check-inline w-40">
                                            <input type="checkbox" v-model="room.amenities" class="form-check-input"
                                                   :value="amenity.id" multiple>
                                            <div class="form-check-label">{{ amenity.name }}</div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" @click.prevent="saveRoomOrService" class="btn btn-warning btn-block">
                        Save <i class="far fa-save"></i>
                    </button>
                </div>
            </div>
        </template>
    </div>
</template>

<script lang="ts">
import {computed, defineComponent, reactive, ref} from "vue";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";
import {Room} from "@/manager/store/property/types";

export default defineComponent({
    name: "RoomForm",
    components: {SummernoteEditor: require("@/manager/components/Shared/SummernoteEditor.vue").default},
    setup() {
        const store = useStore();
        const router = useRouter();
        const route = useRoute();
        const isSending = ref(false);
        const isLoading = computed(() => !!store.state.propertyModule.isLoading);
        const amenities = computed(() => store.state.formOptions.amenities);
        const roomCategories = computed(() => store.state.formOptions.roomCategories);
        const ratePeriods = computed(() => store.state.formOptions.ratePeriods);
        const room = reactive(new Room({propertyId: route.params.propertyId}));
        const formInvalid = computed(() => isSending.value || !room.name || !room.rate || !room.ratePeriod);
        const imageUrl = ref('');

        const handleFileChange = (files: FileList) => {
            const file = files[0];
            imageUrl.value = URL.createObjectURL(file);
            room.photo = file;
        };

        const saveRoomOrService = async () => {
            try {
                isSending.value = true;
                let response = await store.dispatch("propertyModule/saveRoom", room);
                isSending.value = false;
                await store.dispatch("SET_SNACKBAR", {title: response, icon: 'success'});
                await router.push({name: 'manager-properties-details', params: {id: route.params.propertyId}});
            } catch (error) {
                isSending.value = false;
                await store.dispatch("SET_SNACKBAR", {title: "Response Status", html: error, icon: 'error'});
            }
        };

        const getRoom = async () => {
            try {
                if(!route.params.id){
                    return;
                }
                let response = await store.dispatch("propertyModule/getRoomForUpdate", {
                    propertyId: route.params.propertyId || null,
                    id: route.params.id || null
                });
                room.id = response.id;
                room.name = response.name;
                room.description = response.description;
                room.frequency = response.frequency;
                room.bathrooms = response.bathrooms;
                room.rate = response.rate;
                room.ratePeriod = response.ratePeriod;
                room.tax = response.tax;
                room.categoryId = response.categoryId;
                room.amenities = response.amenities;
            } catch (error) {
                await store.dispatch("SET_SNACKBAR", {title: error, icon: 'error'});
                // await router.push({name: 'manager-properties-list'});
            }
        };

        getRoom();
        store.dispatch("GET_FORM_OPTIONS", 'amenities,roomCategories,ratePeriods');

        return {
            room,
            isLoading,
            isSending,
            amenities,
            roomCategories,
            ratePeriods,
            formInvalid,
            imageUrl,
            handleFileChange,
            saveRoomOrService,
        }
    },
});
</script>

<style scoped>

</style>
