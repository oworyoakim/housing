<template>
    <FormModal v-if="isEditing" @submitted="submitRoomOrServiceCategory()" @closed="resetForm()">
        <template v-slot:header>
            Room/Service Category Form
        </template>
        <template v-slot:body>
            <div class="form-group">
                <label>Name</label>
                <input type="text" v-model="roomOrServiceCategory.name"
                       class="form-control"
                       placeholder="Name of the bed type e.g Double bed" required>
                <span class="error invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea v-model="roomOrServiceCategory.description"
                          class="form-control"
                          placeholder="A description of the category"></textarea>
                <span class="error invalid-feedback"></span>
            </div>
        </template>
        <template v-slot:footer>
            <button type="submit"
                    :disabled="formInvalid"
                    class="btn btn-warning btn-block">
                Save <i class="far fa-save"></i>
            </button>
        </template>
    </FormModal>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, ref} from "vue";
import {useStore} from "vuex";
import FormModal from "@/manager/components/Shared/FormModal.vue";
import {RoomOrServiceCategory} from "@/manager/store/room-or-service-category/types";
import {useRoomOrServiceCategory} from "@/manager/store/room-or-service-category";
import EventBus from "@/manager/EventBus";

export default defineComponent({
    name: "RoomOrServiceCategoryForm",
    components: {FormModal},
    setup() {
        const store = useStore();
        const isEditing = ref(false);
        const isSending = ref(false);
        const roomOrServiceCategory = ref(new RoomOrServiceCategory());
        const formInvalid = computed(() => isSending.value || !roomOrServiceCategory.value.name);
        const {saveRoomOrServiceCategory, setSnackbar} = useRoomOrServiceCategory(store);

        const submitRoomOrServiceCategory = async () => {
            try {
                isSending.value = true;
                let response = await saveRoomOrServiceCategory(roomOrServiceCategory.value);
                isSending.value = false;
                await setSnackbar({title: response, icon: 'success'});
                resetForm();
                EventBus.$emit("ROOM_OR_SERVICE_CATEGORY_SAVED");
            } catch (error) {
                isSending.value = false;
                await setSnackbar({title: "Response Status", html: error, icon: 'error'});
            }
        };

        const editRoomOrServiceCategory = async (categoryToEdit?: any) => {
            if (categoryToEdit) {
                roomOrServiceCategory.value = new RoomOrServiceCategory(categoryToEdit);
            } else {
                roomOrServiceCategory.value = new RoomOrServiceCategory();
            }
            isEditing.value = true;
        };

        const resetForm =  () => {
            roomOrServiceCategory.value = new RoomOrServiceCategory();
            isEditing.value = false;
        };

        onMounted(() => {
            EventBus.$on("EDIT_ROOM_OR_SERVICE_CATEGORY", editRoomOrServiceCategory);
        });

        return {
            roomOrServiceCategory,
            isEditing,
            isSending,
            formInvalid,
            submitRoomOrServiceCategory,
            resetForm,
        }
    }
});
</script>

<style lang="scss" scoped>

</style>
