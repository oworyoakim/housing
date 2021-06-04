<template>
    <div class="mt-1">
        <div class="card card-secondary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <router-link class="nav-link"
                                     active-class="active"
                                     data-toggle="pill"
                                     :to="{name: 'manager-properties-details', params: {id: $route.params.id}}"
                                     role="tab">
                            Property Details
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link"
                                     active-class="active"
                                     data-toggle="pill"
                                     :to="{name: 'manager-properties-rooms-or-services', params: {id: $route.params.id}}"
                                     role="tab">
                            Rooms/Services
                        </router-link>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show" role="tabpanel">
                        <template v-if="isLoading || !property">
                            <span class="fa fa-spinner fa-spin"></span>
                        </template>
                        <template v-else>
                            <div class="row">
                                <div class="col-md-5 table-responsive">
                                    <template v-if="property.featuredImage || property.images.length">
                                        <div id="propertyImagesCarousel"
                                             class="carousel slide property-images mt-2 mb-5"
                                             data-ride="carousel">
                                            <!-- slides -->
                                            <div class="carousel-inner shadow">
                                                <template v-if="property.featuredImage">
                                                    <div class="carousel-item active">
                                                        <img class="img-rounded"
                                                             style="height: 250px;"
                                                             :src="property.featuredImage.path"
                                                             alt="Hills">
                                                    </div>
                                                </template>
                                                <template v-for="(image, index) in property.images">
                                                    <div class="carousel-item"
                                                         v-bind:class="{active: !property.featuredImage && index === 0}">
                                                        <img class="img-rounded"
                                                             :src="image.path"
                                                             style="height: 250px;"
                                                             alt="Hills">
                                                    </div>
                                                </template>
                                            </div>
                                            <!-- Thumbnails -->
                                            <ol class="carousel-indicators list-inline">
                                                <template v-if="property.featuredImage">
                                                    <li class="list-inline-item active mr-2">
                                                        <a id="carousel-selector-0"
                                                           class="selected"
                                                           data-slide-to="0"
                                                           data-target="#propertyImagesCarousel">
                                                            <img :src="property.featuredImage.path"
                                                                 style="height: 80px; width: 100px;"
                                                                 class="img-rounded">
                                                        </a>
                                                    </li>
                                                </template>
                                                <template v-for="(image, index) in property.images">
                                                    <li class="list-inline-item ml-2"
                                                        v-bind:class="{active: !property.featuredImage && index === 0}">
                                                        <a :id="'carousel-selector-' + ((!property.featuredImage) ? index : (index + 1))"
                                                           :data-slide-to="(!property.featuredImage) ? index : (index + 1)"
                                                           data-target="#propertyImagesCarousel">
                                                            <img :src="image.thumbnailPath"
                                                                 style="height: 80px; width: 100px;"
                                                                 class="img-rounded">
                                                        </a>
                                                    </li>
                                                </template>
                                            </ol>
                                            <a class="carousel-control-prev" href="#propertyImagesCarousel"
                                               role="button"
                                               data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#propertyImagesCarousel"
                                               role="button"
                                               data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="h4 mt-2">You have not uploaded any photos for this property.</div>
                                        <div class="h4 mt-2">Use the upload area below to upload some showcase photos.
                                        </div>
                                    </template>
                                </div>

                                <div class="col-md-7">
                                    <div class="mb-1 text-right">
                                        <router-link :to="{name: 'manager-properties-list'}" tag="a"
                                                     class="btn btn-info btn-sm"><i
                                            class="fa fa-backward"></i>
                                            Back To List
                                        </router-link>
                                    </div>
                                    <h3>{{property.name}}</h3>
                                    <hr />
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <h3>Address</h3>
                                            <div class="row">
                                                <div class="col-sm-4"><i class="fa fa-map-marker"></i>
                                                    {{ property.country }}
                                                </div>
                                                <div class="col-sm-4"><i class="fa fa-city"></i> {{ property.city }}
                                                </div>
                                                <div class="col-sm-4"><i class="fa fa-street-view"></i>
                                                    {{ property.street }}
                                                </div>
                                                <div class="col-sm-4">{{ property.zip }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-4">
                                            <router-link
                                                :to="{name: 'manager-properties-edit', params: {id: property.id}}"
                                                class="btn btn-info btn-sm"><i
                                                class="fa fa-edit"></i> Edit
                                            </router-link>
                                        </div>
                                        <div class="col-4">
                                            <button v-if="property.published"
                                                    @click="unPublishProperty(property)"
                                                    class="btn btn-warning btn-sm"><i
                                                class="fa fa-thumbs-down"></i> Unpublish
                                            </button>
                                            <button v-else @click="publishProperty(property)"
                                                    class="btn btn-info btn-sm">
                                                <i class="fa fa-thumbs-up"></i> Publish
                                            </button>
                                        </div>
                                        <div class="col-4">

                                        </div>
                                    </div>
                                    <div class="row mt-4 mb-2">
                                        <div class="col-8">
                                            <label>Additional Photos</label>
                                            <input type="file"
                                                   @change="handleFileInputChange($event.target.files)"
                                                   class="form-control pt-3 pb-5"
                                                   accept="image/*" multiple>
                                        </div>
                                        <div class="col-4">
                                            <button type="button"
                                                    @click.prevent="uploadAdditionalPhotos"
                                                    class="btn btn-outline-info mt-5"
                                                    :disabled="isUploading || previewPhotos.length === 0">
                                                <i class="fa fa-upload"></i>
                                                Upload
                                            </button>
                                        </div>
                                        <template v-if="previewPhotos.length > 0">
                                            <div class="col-12">
                                                <h6>Previews</h6>
                                                <template v-for="photo in previewPhotos">
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
                                            <a class="nav-item nav-link active" id="property-description-tab" data-toggle="tab" href="#property-description" role="tab" aria-controls="property-description" aria-selected="true">Description</a>
                                            <a class="nav-item nav-link" id="property-amenities-tab" data-toggle="tab" href="#property-amenities" role="tab" aria-controls="property-amenities" aria-selected="false">Amenities</a>
                                            <a class="nav-item nav-link" id="property-reviews-tab" data-toggle="tab" href="#property-reviews" role="tab" aria-controls="property-reviews" aria-selected="false">Reviews</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content px-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="property-description" role="tabpanel" aria-labelledby="property-description-tab">
                                            <div v-html="property.description"></div>
                                        </div>
                                        <div class="tab-pane fade" id="property-amenities" role="tabpanel" aria-labelledby="property-amenities-tab">
                                            <div class="row mt-1">
                                                <div v-for="amenity in property.amenities" class="col-md-4">
                                                    <PropertyAmenity
                                                        :property-id="property.id"
                                                        :amenity="amenity"
                                                        @AMENITY_REMOVED="getPropertyDetails()"
                                                    />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="property-reviews" role="tabpanel" aria-labelledby="property-reviews-tab">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</template>

<script lang="ts">
import {defineComponent, ref} from "vue";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";
import {useProperty} from "@/manager/store/property";
import PropertyAmenity from "@/manager/components/Amenities/PropertyAmenity.vue";

export default defineComponent({
    name: "PropertyDetails",
    components: {PropertyAmenity},
    setup() {
        const store = useStore();
        const router = useRouter();
        const route = useRoute();
        const isUploading = ref(false);
        const formData = ref(new FormData());
        const previewPhotos = ref(new Array<any>());
        const {
            isLoading,
            property,
            getProperty,
            publishProperty,
            unPublishProperty,
            publishRoom,
            unPublishRoom,
            previewImage,
            setSnackbar,
        } = useProperty(store);

        const handleFileInputChange = (files: FileList) => {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const objectURL = URL.createObjectURL(file);
                previewPhotos.value.push({name: file.name,url: objectURL});
                formData.value.append(`photos[${i}]`, file);
            }
        };

        const resetData = () => {
            formData.value = new FormData(); // Reset it completely
            previewPhotos.value = [];
        };

        const uploadAdditionalPhotos = async () => {
            try {
                if (previewPhotos.value.length === 0) {
                    return;
                }
                isUploading.value = true;
                let response = await store.dispatch("propertyModule/uploadPropertyAdditionalPhotos", {
                    id: route.params.id,
                    formData: formData.value,
                });
                await setSnackbar({title: response, icon: 'success'});
                isUploading.value = false;
                resetData();
                await getProperty();
            } catch (error) {
                console.log(error);
                await setSnackbar( {title: "Response Status", html: error, icon: 'error'});
                isUploading.value = false;
            }
        };

        const getPropertyDetails = async () => {
            try {
                if (!route.params.id) {
                    return;
                }
                await getProperty(route.params.id);
            } catch (error) {
                await setSnackbar({title: error, icon: 'error'});
                await router.push({name: 'manager-properties-list'});
            }
        };

        getPropertyDetails();

        return {
            isLoading,
            property,
            previewPhotos,
            isUploading,
            handleFileInputChange,
            uploadAdditionalPhotos,
            publishProperty,
            unPublishProperty,
            publishRoom,
            unPublishRoom,
            previewImage,
            getPropertyDetails
        }
    },
});
</script>

<style lang="scss" scoped>

</style>
