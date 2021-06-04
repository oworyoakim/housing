<template>
    <div class="mt-1">
        <template v-if="isLoading">
            <span class="fa fa-spinner fa-spin"></span>
        </template>
        <template v-else>
            <div class="row mb-2">
                <div class="col-12">
                    <button type="button"
                            :disabled="isLoading"
                            class="btn btn-info btn-sm float-right"
                            @click="editAmenity()">
                        <i class="fa fa-plus"></i> Add Amenity
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-sm">
                        <thead class="bg-gradient-secondary">
                        <tr>
                            <th>ID</th>
                            <th class="w-25">Name</th>
                            <th class="w-50">Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="amenity in amenities.data">
                            <td>{{ amenity.id }}</td>
                            <td>{{ amenity.name }}</td>
                            <td>{{ amenity.description }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-xs" @click="editAmenity(amenity)">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class="float-right">
                        <Pagination :items="amenities" @gotoPage="getManagerAmenities" small/>
                    </div>
                </div>
            </div>
            <AmenityForm/>
        </template>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted} from "vue";
import {useStore} from "vuex";
import Pagination from "@/manager/components/Shared/Pagination.vue";
import {useAmenity} from "@/manager/store/amenity";
import AmenityForm from "@/manager/components/Amenities/AmenityForm.vue";
import EventBus from "@/manager/EventBus";

export default defineComponent({
    components: {AmenityForm, Pagination},
    setup() {
        const store = useStore();
        const {getManagerAmenities, amenities, isLoading} = useAmenity(store);
        const editAmenity = (amenity?: any) => {
            //console.log(amenity?.id);
            EventBus.$emit("EDIT_AMENITY", amenity);
        }

        onMounted(() => {
            EventBus.$on("AMENITY_SAVED", () => {
                getManagerAmenities();
            });
        });

        getManagerAmenities();

        return {
            amenities,
            isLoading,
            getManagerAmenities,
            editAmenity,
        }
    },
});
</script>

<style scoped>

</style>
