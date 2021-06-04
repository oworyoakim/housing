<template>
    <div class="alert alert-light alert-dismissible fade show" role="alert">
        {{amenity.name}}
        <button @click="removeAmenityFromProperty()" type="button" class="close" :title="`Remove ${amenity.name}`">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script lang="ts">
import {defineComponent, toRefs} from "vue";
import {Amenity} from "@/manager/store/amenity/types";
import { useProperty } from "@/manager/store/property";
import {useStore} from "vuex";

export default defineComponent({
    name: "PropertyAmenity",
    props: {
        propertyId: {type: Number, required: true},
        amenity: {type: Amenity, required: true},
    },
    emits: ["AMENITY_REMOVED"],
    setup(props, {emit}){
        const {propertyId, amenity} = toRefs(props);
        const store = useStore();
        const {removePropertyAmenity, setSnackbar,} = useProperty(store);
        const removeAmenityFromProperty = async () => {
            try {
                let responseAction = await setSnackbar({
                    title: 'Are you sure?',
                    text: "You will remove this amenity from the property!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#343A40',
                    cancelButtonColor: '#d3b056',
                    confirmButtonText: 'Remove'
                });
                if(!responseAction.isConfirmed){
                    return;
                }
                let response = await removePropertyAmenity({propertyId: propertyId.value, amenityId: amenity.value.id});
                await  setSnackbar({title: "Success!", text: response, icon: 'success'});
                emit("AMENITY_REMOVED");
            }catch (error) {
                console.log(error);
                await  setSnackbar({title: "Error!", html: error, icon: 'error'});
            }
        };

        return {
            removeAmenityFromProperty,
        }
    }
})
</script>

<style scoped>

</style>
