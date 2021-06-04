<template>
    <div class="mt-1">
        <template v-if="isLoading">
            <span class="fa fa-spinner fa-spin"></span>
        </template>
        <template v-else>
            <div class="row mb-2">
                <div class="col-12">
                    <button type="button"
                            @click="editRoomOrServiceCategory()"
                            :disabled="isLoading"
                            class="btn btn-info btn-sm float-right">
                        <i class="fa fa-plus mr-1"></i>Add Category
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-sm w-100">
                        <thead class="bg-gradient-secondary">
                        <tr>
                            <th>ID</th>
                            <th class="w-25">Name</th>
                            <th class="w-50">Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="roomOrServiceCategory in roomOrServiceCategories">
                            <td>{{ roomOrServiceCategory.id }}</td>
                            <td>{{ roomOrServiceCategory.name }}</td>
                            <td>{{ roomOrServiceCategory.description }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-xs"
                                        @click="editRoomOrServiceCategory(roomOrServiceCategory)">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <RoomCategoryForm/>
        </template>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted} from "vue";
import {useStore} from "vuex";
import {RoomOrServiceCategory} from "@/manager/store/room-or-service-category/types";
import {useRoomOrServiceCategory} from "@/manager/store/room-or-service-category";
import EventBus from "@/manager/EventBus";
import RoomCategoryForm from "@/manager/components/RoomCategories/RoomCategoryForm.vue";

export default defineComponent({
    name: "RoomCategoriesList",
    components: {RoomCategoryForm},
    setup() {
        const store = useStore();
        const {
            isLoading,
            roomOrServiceCategories,
            getRoomOrServiceCategories
        } = useRoomOrServiceCategory(store);

        const editRoomOrServiceCategory = (roomOrService?: RoomOrServiceCategory) => {
            EventBus.$emit("EDIT_ROOM_OR_SERVICE_CATEGORY", roomOrService);
        }

        onMounted(() => {
            EventBus.$on("ROOM_OR_SERVICE_CATEGORY_SAVED", getRoomOrServiceCategories);
        });

        getRoomOrServiceCategories();

        return {
            isLoading,
            roomOrServiceCategories,
            editRoomOrServiceCategory,
        }
    }
});
</script>

<style lang="scss" scoped>

</style>
