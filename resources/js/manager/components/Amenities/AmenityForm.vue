<template>
    <FormModal v-if="isEditing" @submitted="saveAmenity()" @closed="resetForm()">
        <template v-slot:header>
            Property/Room Amenity Form
        </template>
        <template v-slot:body>
            <div class="form-group">
                <label>Name</label>
                <input type="text" v-model="amenity.name"
                       class="form-control"
                       placeholder="Name of the amenity" required>
                <span class="error invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea v-model="amenity.description"
                          class="form-control"
                          placeholder="A description of the amenity"></textarea>
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
import {Amenity} from "@/manager/store/amenity/types";
import FormModal from "@/manager/components/Shared/FormModal.vue";
import EventBus from "@/manager/EventBus";

export default defineComponent({
    name: "AmenityForm",
    components: {FormModal},
    setup() {
        const store = useStore();
        const isEditing = ref(false);
        const isSending = ref(false);
        const amenity = ref<Amenity>(new Amenity());
        const formInvalid = computed(() => isSending.value || !amenity.value.name);

        const saveAmenity = async () => {
            try {
                isSending.value = true;
                let response = await store.dispatch("amenityModule/saveAmenity", amenity.value);
                isSending.value = false;
                await store.dispatch("SET_SNACKBAR", {title: response, icon: 'success'});
                resetForm();
                EventBus.$emit("AMENITY_SAVED");
            } catch (error) {
                isSending.value = false;
                await store.dispatch("SET_SNACKBAR", {title: "Response Status", html: error, icon: 'error'});
            }
        };

        const editAmenity = async (amenityToEdit?: any) => {
            if (amenityToEdit) {
                amenity.value = new Amenity(amenityToEdit);
            } else {
                amenity.value = new Amenity();
            }
            isEditing.value = true;
            store.commit("TOGGLE_MODAL_OPEN_BODY_CLASS", true);
        };

        const resetForm =  () => {
            amenity.value = new Amenity();
            isEditing.value = false;
            store.commit("TOGGLE_MODAL_OPEN_BODY_CLASS", false);
        };

        onMounted(() => {
            EventBus.$on("EDIT_AMENITY", editAmenity);
        });

        return {
            amenity,
            isEditing,
            isSending,
            formInvalid,
            saveAmenity,
            resetForm,
        }
    }
});
</script>

<style scoped>

</style>
