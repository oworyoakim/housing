<template>
    <div class="mt-2">
        <template v-if="isLoading || !properties">
            <span class="fa fa-spinner fa-spin"></span>
        </template>
        <template v-else>
            <div class="card">
                <div class="card-header bg-gradient-secondary">
                    <div class="card-tools">
                        <router-link :to="{name: 'manager-properties-edit'}" class="btn btn-info btn-sm"><i
                            class="fa fa-plus"></i> Add Property
                        </router-link>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead class="bg-gradient-secondary text-center">
                        <tr>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Title</th>
                            <th>Rooms/Services</th>
                            <th class="w-25">Amenities</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-if="properties.total > 0">
                            <tr v-for="property in properties.data">
                                <td>
                                    <img v-if="property.featuredImage" width="80" :src="property.featuredImage.thumbnailPath"
                                         class="img-thumbnail"/>
                                </td>
                                <td>
                                    <label v-if="property.published"
                                           class="badge badge-success">online</label>
                                    <label v-else class="badge badge-secondary">offline</label>
                                </td>
                                <td>{{ property.name }}</td>
                                <td class="text-center">{{ property.numberOfRooms }}</td>
                                <td>{{ property.amenitiesForDisplay }}</td>
                                <td>
                                    <router-link :to="{name: 'manager-properties-details', params: {id: property.id}}"
                                                 class="btn btn-info btn-sm m-1" tag="a"><i
                                        class="fa fa-cog"></i> Manage
                                    </router-link>
                                    <router-link :to="{name: 'manager-properties-edit', params: {id: property.id}}"
                                                 class="btn btn-outline-info btn-sm m-1" tag="a"><i
                                        class="fa fa-edit"></i> Edit
                                    </router-link>
                                    <button v-if="property.published"
                                            @click="unPublishProperty(property)" class="btn btn-warning btn-sm m-1"><i
                                        class="fa fa-thumbs-down"></i> Unpublish
                                    </button>
                                    <button v-else @click="publishProperty(property)"
                                            class="btn btn-secondary btn-sm m-1"><i
                                        class="fa fa-thumbs-up"></i> Publish
                                    </button>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="4">
                                    <div class="h2 my-2">
                                        You do not have any properties added to your account.
                                    </div>
                                    <div class="h2 my-2">
                                        To create your properties, click the plus button at the bottom to get started!
                                    </div>
                                    <div class="text-center text-warning">
                                        <i class="fa fa-arrow-down fa-5x"></i>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <Pagination :items="properties" @gotoPage="getManagerProperties"/>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script lang="ts">
import {computed, defineComponent, reactive} from "vue";
import {useStore} from "vuex";
import Pagination from "@/manager/components/Shared/Pagination.vue";
import {useProperty} from "@/manager/store/property";

export default defineComponent({
    name: "PropertyList",
    components: {Pagination},
    setup() {
        const store = useStore();
        const currentPage = reactive(store.state.propertyModule.currentPage);
        const properties = computed(() => store.state.propertyModule.managerProperties);
        const isLoading = computed(() => store.state.propertyModule.isLoading);
        const {publishProperty, unPublishProperty} = useProperty(store);


        const getManagerProperties = async (page = 0) => {
            if (page > 0) {
                store.commit('propertyModule/setCurrentPage', page);
            }
            await store.dispatch("propertyModule/getManagerProperties", {page: page || currentPage});
        }

        getManagerProperties();

        return {
            properties,
            isLoading,
            getManagerProperties,
            publishProperty,
            unPublishProperty,
        }
    },
});
</script>

<style scoped>

</style>
