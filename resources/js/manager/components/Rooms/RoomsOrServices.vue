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
                        <template v-if="isLoading">
                            <span class="fa fa-spinner fa-spin"></span>
                        </template>
                        <template v-else>
                            <div class="mb-2 text-right">
                                <router-link
                                    :to="{name: 'manager-properties-rooms-edit', params: {propertyId: $route.params.id}}"
                                    class="btn btn-info btn-sm">
                                    <i class="fa fa-plus"></i>
                                    Add Room or Service
                                </router-link>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm w-100">
                                    <thead class="bg-gradient-secondary text-center">
                                    <tr>
                                        <th>Thumbnail</th>
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Count</th>
                                        <th>Rate</th>
                                        <th class="w-25">Amenities</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-if="roomsOrServices.length > 0">
                                        <tr v-for="room in roomsOrServices">
                                            <td>
                                                <template v-if="room.featuredImage">
                                                    <img class="img-thumbnail img-size-64"
                                                         :src="room.featuredImage.thumbnailPath"
                                                         :alt="room.name">
                                                </template>
                                            </td>
                                            <td>
                                                <label v-if="room.published"
                                                       class="badge badge-success">online</label>
                                                <label v-else class="badge badge-secondary">offline</label>
                                            </td>
                                            <td>{{ room.name }}</td>
                                            <td>
                                                <template v-if="room.category">
                                                    {{ room.category.name }}
                                                </template>
                                            </td>
                                            <td>{{ room.frequency }}</td>
                                            <td>
                                                {{ room.listingCurrencySymbol }} {{ room.rate }} /{{ room.ratePeriod }}
                                            </td>
                                            <td>{{ room.amenitiesForDisplay }}</td>
                                            <td>
                                                <router-link
                                                    :to="{name: 'manager-properties-rooms-details', params: {propertyId: $route.params.id, id: room.id}}"
                                                    class="btn btn-info btn-sm m-1"><i
                                                    class="fa fa-cog"></i> Manage
                                                </router-link>
                                                <router-link
                                                    :to="{name: 'manager-properties-rooms-edit', params: {propertyId: $route.params.id, id: room.id}}"
                                                    class="btn btn-outline-info btn-sm m-1"><i
                                                    class="fa fa-edit"></i> Edit
                                                </router-link>
                                                <button v-if="room.published"
                                                        @click="unPublishRoom(room)"
                                                        class="btn btn-warning btn-sm m-1"><i
                                                    class="fa fa-thumbs-down"></i> Unpublish
                                                </button>
                                                <button v-else @click="publishRoom(room)"
                                                        class="btn btn-secondary btn-sm m-1"><i
                                                    class="fa fa-thumbs-up"></i> Publish
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="7" class="text-muted small">
                                                <h4>You do not have any rooms and/or services attached to this
                                                    property.</h4>
                                                <h4>Please add some rooms and/or services by clicking the add button
                                                    above.</h4>
                                            </td>
                                        </tr>
                                    </template>
                                    </tbody>
                                </table>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import {useStore} from "vuex";
import {useRoute} from "vue-router";
import {useProperty} from "@/manager/store/property";

export default defineComponent({
    name: "PropertyRoomsOrServices",
    setup() {
        const store = useStore();
        const route = useRoute();
        const {
            isLoading,
            roomsOrServices,
            getPropertyRooms,
            publishRoom,
            unPublishRoom,
        } = useProperty(store);

        getPropertyRooms(route.params.id);

        return {
            isLoading,
            roomsOrServices,
            publishRoom,
            unPublishRoom,
        }
    },
});
</script>

<style lang="scss" scoped>

</style>
