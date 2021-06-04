<template>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-sm-inline-block">
                <a href="#" class="nav-link text-bold">{{$route.meta.title}}</a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a @click="logout()" href="javascript:void(0);" class="nav-link">
                    <i class="fa fa-power-off"></i>
                    &nbsp;Logout
                </a>
            </li>
        </ul>
    </nav>
</template>

<script lang="ts">
import {defineComponent} from 'vue';
import {useStore} from "vuex";

export default defineComponent({
    name: 'ManagerNavbar',
    setup() {
        const store = useStore();
        const logout = async () => {
            try {
                let response = await store.dispatch('LOGOUT');
                await store.dispatch('SET_SNACKBAR',{title: response, icon: 'success'});
                location.href = '/';
            } catch (error) {
                await store.dispatch('SET_SNACKBAR',{title: error, icon: 'error'});
            }
        };
        return {
            logout
        }
    }
});
</script>

<style scoped>

</style>
