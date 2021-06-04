<template>
    <div class="mt-2">
        <template v-if="isLoading || !room">
            <span class="fa fa-spinner fa-spin"></span>
        </template>
        <template v-else>
            <div class="card card-solid">
                <div class="card-body">
                    <div class="mb-2 text-right">
                        <router-link :to="{name: 'manager-properties-rooms-or-services', params: {id: $route.params.propertyId}}" class="btn btn-info btn-sm mr-2">
                            <i class="fa fa-cog"></i> Property Details
                        </router-link>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="col-12">
                                <img v-if="activeImage"
                                     :src="activeImage.path"
                                     class="img-rounded"
                                     style="height: 250px !important;"
                                     alt="Room Image">
                            </div>
                            <div class="col-12 product-image-thumbs">
                                <div v-if="room.featuredImage"
                                     class="product-image-thumb"
                                     :class="{active: activeImage.id === room.featuredImage.id}"
                                     :disabled="activeImage.id === room.featuredImage.id"
                                     @click="setActiveImage(room.featuredImage)">
                                    <img :src="room.featuredImage.thumbnailPath" class="img-size-64 img-rounded" alt="Room Image">
                                </div>
                                <template v-for="image in room.images">
                                    <div class="product-image-thumb"
                                         :class="{active: activeImage.id === image.id}"
                                         :disabled="activeImage.id === image.id"
                                         @click="setActiveImage(image)">
                                        <img :src="image.thumbnailPath"  class="img-size-64 img-rounded" alt="Room Image">
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="col-12 col-md-7">
                            <h3 class="mb-3">{{room.name}}</h3>
                            <hr>
                            <h5>Beds <span class="badge badge-dark float-right">{{room.numberOfBeds}}</span></h5>
                            <h5>Capacity <span class="badge badge-dark float-right">{{room.totalCapacity}}</span></h5>
                            <div class="bg-gray py-2 px-3 mt-4">
                                <h2 class="mb-0">
                                    {{ room.listingCurrencySymbol }} {{ $filters.numberFormat(room.rate) }} / {{ room.ratePeriod }}
                                </h2>
                                <h4 class="mt-0">
                                    <small>Excluding Tax: {{ room.listingCurrencySymbol }} {{ $filters.numberFormat(room.tax * room.rate) }} </small>
                                </h4>
                            </div>

                            <div class="mt-4">
                                <router-link :to="{name: 'manager-properties-rooms-edit', params: {propertyId: room.propertyId, id: room.id}}" class="btn btn-info btn-sm mx-1">
                                    <i class="fas fa-edit fa-lg mr-2"></i>
                                    Edit
                                </router-link>
                                <button v-if="room.published" @click="unPublishRoom(room)" class="btn btn-warning btn-sm mx-1">
                                    <i class="fas fa-thumbs-down fa-lg mr-2"></i>
                                    Unpublish
                                </button>
                                <button v-else @click="publishRoom(room)" class="btn btn-secondary btn-sm mx-1">
                                    <i class="fas fa-thumbs-up fa-lg mr-2"></i>
                                    Publish
                                </button>
                            </div>

                            <div class="mt-4 room-share">
                                <a href="#" class="text-gray mx-1">
                                    <i class="fab fa-facebook-square fa-2x"></i>
                                </a>
                                <a href="#" class="text-gray mx-1">
                                    <i class="fab fa-twitter-square fa-2x"></i>
                                </a>
                            </div>

                            <div class="row mt-4 mb-2">
                                <div class="col-8">
                                    <h4>Additional Photos</h4>
                                    <input type="file"
                                           @change="handleFileInputChange($event.target.files)"
                                           class="form-control pt-3 pb-5"
                                           accept="image/*" multiple>
                                </div>
                                <div class="col-4">
                                    <button type="button"
                                            @click.prevent="uploadAdditionalPhotos"
                                            class="btn btn-outline-info mt-5"
                                            :disabled="isUploading || photos.length === 0">
                                        <i class="fa fa-upload"></i>
                                        Upload
                                    </button>
                                </div>
                                <template v-if="photos.length > 0">
                                    <div class="col-12">
                                        <h6>Previews</h6>
                                        <template v-for="photo in photos">
                                            <img @click="previewImage(photo)" :src="photo.url" class="img-size-64 img-thumbnail m-1">
                                        </template>
                                    </div>
                                </template>
                            </div>

                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <nav class="w-100">
                                <div class="nav nav-tabs" id="product-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="room-description-tab" data-toggle="tab" href="#room-description" role="tab" aria-controls="room-description" aria-selected="true">Description</a>
                                    <a class="nav-item nav-link" id="room-amenities-tab" data-toggle="tab" href="#room-amenities" role="tab" aria-controls="room-amenities" aria-selected="false">Amenities</a>
                                    <a class="nav-item nav-link" id="room-beds-tab" data-toggle="tab" href="#room-beds" role="tab" aria-controls="room-beds" aria-selected="false">Available Beds</a>
                                    <a class="nav-item nav-link" id="room-reviews-tab" data-toggle="tab" href="#room-reviews" role="tab" aria-controls="room-reviews" aria-selected="false">Reviews</a>
                                </div>
                            </nav>
                            <div class="tab-content px-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="room-description" role="tabpanel" aria-labelledby="room-description-tab">
                                    <div v-html="room.description"></div>
                                </div>
                                <div class="tab-pane fade" id="room-amenities" role="tabpanel" aria-labelledby="room-amenities-tab">
                                    <div class="row mt-1">
                                        <div v-for="amenity in room.amenities" class="col-4">
                                            <!--
                                            <div class="alert alert-light alert-dismissible fade show" role="alert">
                                                {{amenity.name}}
                                                <button @click="removeAmenityFromRoom({roomId: room.id, amenityId: amenity.id})" type="button" class="close" data-dismiss="alert" aria-label="Remove">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            -->
                                            <RoomAmenity
                                                :room-id="room.id"
                                                :amenity="amenity"
                                                @AMENITY_REMOVED="getRoom()"
                                            />
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="room-beds" role="tabpanel" aria-labelledby="room-beds-tab">
                                    <div class="my-1">
                                        <button type="button"
                                                @click="editBed()"
                                                class="btn btn-info btn-sm float-right mb-1">
                                            <i class="fa fa-plus"></i> Add Bed
                                        </button>
                                    </div>
                                    <div class="my-1 table-responsive">
                                        <table class="table table-sm w-100">
                                            <thead class="bg-gradient-secondary">
                                            <tr>
                                                <th>Name</th>
                                                <th>Capacity</th>
                                                <th>Count</th>
                                                <th>Total Capacity</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="bed in room.beds">
                                                <td>{{bed.name}}</td>
                                                <td>{{bed.capacity}}</td>
                                                <td>{{bed.numberOfBeds}}</td>
                                                <td>{{bed.totalCapacity}}</td>
                                                <td>
                                                    <button type="button"
                                                            @click="editBed(bed)"
                                                            class="btn btn-info btn-sm m-1"><i
                                                        class="fa fa-edit"></i>
                                                    </button>

                                                    <button type="button"
                                                            @click="removeBedFromRoom({roomId: room.id, bedTypeId: bed.id})"
                                                            class="btn btn-danger btn-sm m-1"><i
                                                        class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <BedForm @BED_SAVED="getRoom()" />
                                </div>
                                <div class="tab-pane fade" id="room-reviews" role="tabpanel" aria-labelledby="room-reviews-tab">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </template>
    </div>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, reactive, ref} from "vue";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";
import {useProperty} from "@/manager/store/property";
import {Image} from "@/manager/store/property/types";
import {Bed} from "@/manager/store/bed-types/types";
import EventBus from "@/manager/EventBus";
import BedForm from "@/manager/components/Rooms/BedForm.vue";
import RoomAmenity from "@/manager/components/Amenities/RoomAmenity.vue";

export default defineComponent({
    name: "RoomDetails",
    components: {RoomAmenity, BedForm},
    setup() {
        const store = useStore();
        const router = useRouter();
        const route = useRoute();
        const isLoading = computed(() => store.state.propertyModule.isLoading);
        const isUploading = ref(false);
        const room = computed(() => store.state.propertyModule.activeRoom);
        const formData = ref(new FormData());
        const photos = ref(new Array<any>());
        const activeImage = reactive(new Image());
        const {
            getRoomForManager,
            publishRoom,
            unPublishRoom,
            previewImage,
            removeBed,
            removeRoomAmenity,
            setSnackbar,
        } = useProperty(store);

        const setActiveImage = (image: Image) => {
            Object.assign(activeImage, image);
        };

        const getRoom = async () => {
            try {
                if (!route.params.id || !route.params.propertyId) {
                    return;
                }
                let roomFromServer = await getRoomForManager({
                    id: route.params.id || null,
                    propertyId: route.params.propertyId || null
                });
                if(roomFromServer && roomFromServer.featuredImage){
                    setActiveImage(roomFromServer.featuredImage);
                }
            } catch (error) {
                await setSnackbar( {title: error, icon: 'error'});
                await router.push({name: 'manager-properties-details', params: {id: route.params.propertyId}});
            }
        };

        const handleFileInputChange = (files: FileList) => {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const objectURL = URL.createObjectURL(file);
                photos.value.push({
                    name: file.name,
                    url: objectURL,
                });
                formData.value.append(`photos[${i}]`, file);
            }
        };

        const resetData = () => {
            formData.value = new FormData(); // Reset it completely
            photos.value = [];
        };

        const uploadAdditionalPhotos = async () => {
            try {
                if (photos.value.length === 0) {
                    return;
                }
                formData.value.append('propertyId', route.params.propertyId as string);
                isUploading.value = true;
                let response = await store.dispatch("propertyModule/uploadRoomAdditionalPhotos", {
                    id: route.params.id,
                    formData: formData.value,
                });
                await setSnackbar( {title: response, icon: 'success'});
                isUploading.value = false;
                resetData();
                await getRoom();
            } catch (error) {
                console.log(error);
                await setSnackbar( {title: "Response Status", html: error, icon: 'error'});
                isUploading.value = false;
            }
        };

        const editBed = (bed?: Bed) => {
            EventBus.$emit("EDIT_BED", {
                bedTypeId: bed?.id,
                numberOfBeds: bed?.numberOfBeds
            });
        }

        const removeBedFromRoom = async (payload: {roomId: number, bedTypeId: number}) => {
            try {
                let responseAction = await setSnackbar({
                    title: 'Are you sure?',
                    text: "You will remove this bed from the room!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#343A40',
                    cancelButtonColor: '#d3b056',
                    confirmButtonText: 'Remove'
                });
                if(!responseAction.isConfirmed){
                    return;
                }
                let response = await removeBed(payload);
                await  setSnackbar({title: "Success!", text: response, icon: 'success'});
                //EventBus.$emit("BED_REMOVED");
                getRoom();
            }catch (error) {
                console.log(error);
                await  setSnackbar({title: "Error!", html: error, icon: 'error'});
            }
        };

        const removeAmenityFromRoom = async (payload: {roomId: number, amenityId: number}) => {
            try {
                let responseAction = await setSnackbar({
                    title: 'Are you sure?',
                    text: "You will remove this amenity from the room!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#343A40',
                    cancelButtonColor: '#d3b056',
                    confirmButtonText: 'Remove'
                });
                if(!responseAction.isConfirmed){
                    return;
                }
                let response = await removeRoomAmenity(payload);
                await  setSnackbar({title: "Success!", text: response, icon: 'success'});
                //EventBus.$emit("AMENITY_REMOVED");
                getRoom();
            }catch (error) {
                console.log(error);
                await  setSnackbar({title: "Error!", html: error, icon: 'error'});
            }
        };

        onMounted(() => {
            EventBus.$on(['BED_SAVED', 'BED_REMOVED','AMENITY_REMOVED'], () => {
                getRoom();
            });
        });

        getRoom();

        return {
            isLoading,
            room,
            photos,
            isUploading,
            activeImage,
            setActiveImage,
            handleFileInputChange,
            uploadAdditionalPhotos,
            publishRoom,
            unPublishRoom,
            previewImage,
            editBed,
            removeBedFromRoom,
            getRoom,
            removeAmenityFromRoom,
        }
    },
});
</script>

<style scoped>

</style>
