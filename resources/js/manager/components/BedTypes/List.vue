<template>
    <div class="mt-1">
        <template v-if="isLoading">
            <span class="fa fa-spinner fa-spin"></span>
        </template>
        <template v-else>
            <div class="row mb-2">
                <div class="col-12">
                    <button type="button"
                            @click="editBedType()"
                            :disabled="isLoading"
                            class="btn btn-info btn-sm float-right">
                        <i class="fa fa-plus mr-1"></i>Add Bed Type
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-sm w-100">
                        <thead class="bg-gradient-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Sleeps</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="bedType in bedTypes">
                            <td>{{ bedType.id }}</td>
                            <td>{{ bedType.name }}</td>
                            <td>{{ bedType.capacity }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-xs" @click="editBedType(bedType)">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <BedTypeForm/>
        </template>
    </div>
</template>

<script lang="ts">
import {defineComponent, onMounted} from "vue";
import {useStore} from "vuex";
import EventBus from "@/manager/EventBus";
import {useBedTypes} from "@/manager/store/bed-types";
import BedTypeForm from "@/manager/components/BedTypes/BedTypeForm.vue";

export default defineComponent({
    name: "BedTypesList",
    components: {BedTypeForm},
    setup() {
        const store = useStore();
        const {getBedTypes, bedTypes, isLoading} = useBedTypes(store);
        const editBedType = (bedType?: any) => {
            EventBus.$emit("EDIT_BED_TYPE", bedType);
        }

        onMounted(() => {
            EventBus.$on("BED_TYPE_SAVED", getBedTypes);
        });

        getBedTypes();
        return {
            isLoading,
            bedTypes,
            editBedType,
        }
    }
});
</script>

<style lang="scss" scoped>

</style>
