<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="/assets/img/logo.png"
                 alt="Housing"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Housing</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/assets/img/avatar.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <router-link to="/manager/profile" tag="a" class="d-block">John Doe</router-link>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link to="/manager/dashboard" class="nav-link" active-class="active"
                                     exact-active-class="active" tag="a">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-header">MANAGE ACCOUNT</li>
                    <li class="nav-item">
                        <router-link to="/manager/settings" class="nav-link" active-class="active" tag="a">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/manager/properties" class="nav-link" active-class="active" tag="a">
                            <i class="nav-icon far fa-building"></i>
                            <p>
                                Properties
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/manager/reservations" class="nav-link" active-class="active" tag="a">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>
                                Reservations
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/manager/profile" class="nav-link" active-class="active"
                                     exact-active-class="active" tag="a">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Profile
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </router-link>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script lang="ts">
import {defineComponent} from 'vue';

export default defineComponent({
    name: 'ManagerSidebar',
});
</script>

<style scoped>

</style>
