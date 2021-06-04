<template>
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <ManagerNavbar />
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <ManagerSidebar />
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <ManagerContainer />
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <ManagerFooter />
  </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import {useStore} from "vuex";
import ManagerNavbar from "./ManagerNavbar.vue";
import ManagerSidebar from "./ManagerSidebar.vue";
import ManagerFooter from "./ManagerFooter.vue";
import ManagerContainer from "./Container.vue";

export default defineComponent({
  name: 'ManagerApp',
  components: {ManagerContainer, ManagerNavbar, ManagerSidebar, ManagerFooter},
    created(){
        const store = useStore();
        store.dispatch('GET_USER_DATA');
    },
});
</script>
<style lang="scss">
.w-40 {
    width: 40%;
}

@media screen and (max-width: 400px) {
    .w-40 {
        width: 100%;
    }
}
</style>
