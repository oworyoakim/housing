<!-- Header Start -->
<header class="header-two">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-6 col-7">
                <div class="logo-wrap d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="{{route('home')}}"><img src="/assets/img/logo-transparent.png" alt="Avson"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-6 col-5">
                <div class="menu-right-area text-right">
                    <nav class="main-menu">
                        <ul class="list-inline">
                            <li class="@if(Request::is('/'))  active-page @endif"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="@if(Request::is('rooms'))  active-page @endif"><a
                                    href="{{route('rooms')}}">Rooms</a></li>
                            <li class="@if(Request::is('contact-us'))  active-page @endif"><a
                                    href="{{route('contact-us')}}">Contact</a></li>
                            @if(auth()->check())
                                <li class="have-submenu ml-lg-5">
                                    <a href="javascript:void(0);">{{auth()->user()->name}}</a>
                                    <ul class="submenu user-menu">
                                        <li><a href="{{route('profile')}}">Profile</a></li>
                                        @if(auth()->user()->account_type == 'manager')
                                            <li><a href="{{route('manager-dashboard')}}">Dashboard</a></li>
                                            <li><a href="{{route('properties')}}">Manage Properties</a></li>
                                            <li><a href="{{route('reservations')}}">Manage Reservations</a></li>
                                        @else
                                            <li><a href="{{route('bookings')}}">Your Orders</a></li>
                                        @endif
                                        <li>
                                            @livewire('auth.logout')
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li><a class="btn btn-warning filled-btn my-1 py-0" href="{{route('register')}}">Sign
                                        Up</a></li>
                                <li><a class="btn btn-outline-dark filled-btn my-1 py-0"
                                       href="{{route('login')}}">Login</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="mobilemenu"></div>
    </div>
</header>
<!-- Header End -->
