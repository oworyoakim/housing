<template>
    <div class="row">
        <div class="col-12">
            <div class="mt-2">
                <h1>Manager Dashboard is under construction!</h1>
                <div class="row">
                    <div class="col-md-12">
                        <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
                            <!-- slides -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://i.imgur.com/weXVL8M.jpg" alt="Hills">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://i.imgur.com/Rpxx6wU.jpg" alt="Hills">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://i.imgur.com/83fandJ.jpg" alt="Hills">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://i.imgur.com/JiQ9Ppv.jpg" alt="Hills">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#custCarousel" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#custCarousel" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                            <!-- Thumbnails -->
                            <ol class="carousel-indicators list-inline">
                                <li class="list-inline-item active">
                                    <a class="selected" data-slide-to="0" data-target="#custCarousel"></a>
                                </li>
                                <li class="list-inline-item">
                                    <a data-slide-to="1" data-target="#custCarousel"></a>
                                </li>
                                <li class="list-inline-item">
                                    <a data-slide-to="2" data-target="#custCarousel"></a>
                                </li>
                                <li class="list-inline-item">
                                    <a data-slide-to="3" data-target="#custCarousel"></a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import RoomsList from "@/site/components/Shared/RoomsList.vue";

export default defineComponent({
    name: 'ManagerDashboard',
    components: {RoomsList},
});
</script>

<style scoped>

</style>
