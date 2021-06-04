<template>
    <FormModal v-if="isEditing" @submitted="submitBed()" @closed="resetForm()">
        <template v-slot:header>
            Bed Form
        </template>
        <template v-slot:body>
            <div class="form-group">
                <label>Bed Type<span class="text-red">*</span></label>
                <select v-model="bed.bedTypeId" class="form-control" required>
                    <option value="">The type of bed?</option>
                    <option v-for="bedType in bedTypes" :value="bedType.id">
                        {{ bedType.name }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label>How many?<span class="text-red">*</span></label>
                <input type="number"
                       v-model="bed.numberOfBeds"
                       class="form-control"
                       min="0"
                       max="10"
                       placeholder="The number of the beds in the room e.g 2"
                       required>
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
import {useRoute} from "vue-router";
import {Bed} from "@/manager/store/bed-types/types";
import {useBedTypes} from "@/manager/store/bed-types";
import {useProperty} from "@/manager/store/property";
import EventBus from "@/manager/EventBus";
import FormModal from "@/manager/components/Shared/FormModal.vue";

export default defineComponent({
    name: "BedForm",
    components: {FormModal},
    emits: ['BED_SAVED'],
    setup(props, {emit}) {
        const store = useStore();
        const route = useRoute();
        const isSending = ref(false);
        const isEditing = ref(false);
        const bed = ref(new Bed({roomId: route.params.id}));
        const formInvalid = computed(() => isSending.value || !bed.value.roomId || !bed.value.bedTypeId || bed.value.numberOfBeds <= 0);
        const {saveBed, setSnackbar} = useProperty(store);
        const {bedTypesOptions, getBedTypesOptions} = useBedTypes(store);

        const editBed = (bedToEdit?: any) => {
            if (bedToEdit) {
                bed.value = new Bed({...bedToEdit, roomId: route.params.id});
            } else {
                bed.value = new Bed({
                    roomId: route.params.id,
                });
            }
            isEditing.value = true;
        };

        const submitBed = async () => {
            try {
                isSending.value = true;
                let response = await saveBed(bed.value);
                isSending.value = false;
                await setSnackbar({title: response, icon: 'success'});
                resetForm();
                //EventBus.$emit("BED_SAVED");
                emit("BED_SAVED");
            } catch (error) {
                isSending.value = false;
                await setSnackbar({title: "Response Status", html: error, icon: 'error'});
            }
        };

        const resetForm = () => {
            bed.value = new Bed({roomId: route.params.id});
            isEditing.value = false;
        };

        onMounted( () => {
            EventBus.$on("EDIT_BED", editBed);
        });

        getBedTypesOptions();

        return {
            isEditing,
            isSending,
            formInvalid,
            bed,
            editBed,
            submitBed,
            resetForm,
            bedTypes: bedTypesOptions,
        }
    }
})
</script>

<style scoped>

</style>
