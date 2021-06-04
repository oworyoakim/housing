<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="/assets/img/logo.png"
             alt="{{trans('panel.site_title')}}"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{trans('panel.site_title')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/assets/img/avatar.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('profile')}}" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('manager-dashboard')}}" class="nav-link @if(Request::is('manage/dashboard')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-header">MANAGE ACCOUNT</li>
                <li class="nav-item">
                    <a href="{{route('properties')}}" class="nav-link @if(Request::is('manage/properties*')) active @endif">
                        <i class="nav-icon far fa-building"></i>
                        <p>
                            Properties
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('manage-rooms')}}" class="nav-link @if(Request::is('manage/rooms*')) active @endif">
                        <i class="nav-icon fas fa-bed"></i>
                        <p>
                            Rooms
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('amenities')}}" class="nav-link @if(Request::is('manage/amenities*')) active @endif">
                        <i class="nav-icon fas fa-hot-tub"></i>
                        <p>
                            Amenities
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('bed-types')}}" class="nav-link @if(Request::is('manage/bed-types*')) active @endif">
                        <i class="nav-icon fas fa-bed"></i>
                        <p>
                            Bed Types
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('room-categories')}}" class="nav-link @if(Request::is('manage/room-categories*')) active @endif">
                        <i class="nav-icon fas fa-hotel"></i>
                        <p>
                            Room Categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('reservations')}}" class="nav-link @if(Request::is('manage/reservations*')) active @endif">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Reservations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('manager-profile')}}" class="nav-link @if(Request::is('manage/profile')) active @endif">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Profile
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
