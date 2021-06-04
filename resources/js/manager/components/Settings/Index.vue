<template>
    <div class="mt-2">
        <div class="card card-secondary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <router-link :to="{name: 'amenities-settings'}" tag="a" class="nav-link" active-class="active" role="tab">
                            Amenities
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'bed-types-settings'}" tag="a" class="nav-link" active-class="active" role="tab">
                            Bed Types
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'room-or-service-categories-settings'}" tag="a" class="nav-link" active-class="active" role="tab">
                            Room/Service Categories
                        </router-link>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0">
                <div class="tab-content" id="custom-tabs-settings-tabContent">
                    <div class="tab-pane fade active show" role="tabpanel">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!--
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <Amenities />
        </div>
        <div class="col-md-6 col-sm-12">
            <BedTypes />
        </div>
        <div class="col-md-6 col-sm-12">
            <RoomCategory />
        </div>
    </div>
    -->
</template>

<script lang="ts">
import {defineComponent} from "vue";
import Amenities from "@/manager/components/Amenities/List.vue";
import BedTypes from "@/manager/components/BedTypes/List.vue";
import RoomCategory from "@/manager/components/RoomCategories/List.vue";

export default defineComponent({
    components: {BedTypes, RoomCategory, Amenities},

});
</script>

<style scoped>

</style>
