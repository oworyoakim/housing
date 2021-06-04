<template>
    <FormModal v-if="isEditing" @submitted="submitBedType()" @closed="resetForm()">
        <template v-slot:header>
            Bed Type Form
        </template>
        <template v-slot:body>
            <div class="form-group">
                <label>Name</label>
                <input type="text" v-model="bedType.name"
                       class="form-control"
                       placeholder="Name of the bed type e.g Double bed" required>
                <span class="error invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Capacity</label>
                <input type="number"
                       v-model="bedType.capacity"
                       class="form-control"
                       min="0"
                       max="10"
                       placeholder="The capacity of the bed type e.g 2">
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
import FormModal from "@/manager/components/Shared/FormModal.vue";
import {useStore} from "vuex";
import {BedType} from "@/manager/store/bed-types/types";
import {useBedTypes} from "@/manager/store/bed-types";
import EventBus from "@/manager/EventBus";

export default defineComponent({
    name: "BedTypeForm",
    components: {FormModal},
    setup() {
        const store = useStore();
        const isEditing = ref(false);
        const isSending = ref(false);
        const bedType = ref(new BedType());
        const formInvalid = computed(() => isSending.value || !bedType.value.name || !bedType.value.capacity);
        const {saveBedType, setSnackbar} = useBedTypes(store);

        const submitBedType = async () => {
            try {
                isSending.value = true;
                let response = await saveBedType(bedType.value);
                isSending.value = false;
                await setSnackbar({title: response, icon: 'success'});
                resetForm();
                EventBus.$emit("BED_TYPE_SAVED");
            } catch (error) {
                isSending.value = false;
                await setSnackbar({title: "Response Status", html: error, icon: 'error'});
            }
        };

        const editBedType = async (bedTypeToEdit?: any) => {
            if (bedTypeToEdit) {
                bedType.value = new BedType(bedTypeToEdit);
            } else {
                bedType.value = new BedType();
            }
            isEditing.value = true;
        };

        const resetForm =  () => {
            bedType.value = new BedType();
            isEditing.value = false;
        };

        onMounted(() => {
            EventBus.$on("EDIT_BED_TYPE", editBedType);
        });

        return {
            bedType,
            isEditing,
            isSending,
            formInvalid,
            submitBedType,
            resetForm,
        }
    }
});
</script>

<style lang="scss" scoped>

</style>
