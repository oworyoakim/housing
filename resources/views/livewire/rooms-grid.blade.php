<div>
    <!-- Latest Room Section -->
    <section class="rooms-warp gird-view section-bg section-padding">
        <div class="container-fluid">
            @include('page-welcome-message', ['message' => 'Find your perfect home away from home!'])
            <div class="row">
                <div class="col-md-4">
                    <div class="sidebar-wrap">
                        <div class="widget fillter-widget">
                            <h4 class="widget-title">Find Your Room</h4>
                            <form>
                                <div class="input-wrap">
                                    <input type="text" placeholder="Location" id="location">
                                    <i class="far fa-search"></i>
                                </div>
                                <div class="input-wrap">
                                    <input type="text" placeholder="Arrive Date" id="arrive-date">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="input-wrap">
                                    <input type="text" placeholder="Depart Date" id="depart-date">
                                    <i class=""></i>
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="input-wrap">
                                    <select name="rooms" id="rooms">
                                        <option value="" disabled selected>Rooms</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="input-wrap">
                                    <select name="adults" id="adults">
                                        <option value="" disabled selected>Adults</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="input-wrap">
                                    <select name="child" id="child">
                                        <option value="" disabled selected>Children</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="input-wrap">
                                    <div class="price-range-wrap">
                                        <div class="slider-range">
                                            <div id="slider-range"></div>
                                        </div>
                                        <div class="price-ammount">
                                            <input type="text" id="amount" name="price"
                                                   placeholder="Add Your Price" />
                                        </div>
                                    </div>
                                </div>
                                <div class="input-wrap">
                                    <div class="checkboxes">
                                        <p>
                                            <input type="checkbox" value="guest-room" id="guest-room">
                                            <label for="guest-room">Guest Room</label>
                                        </p>
                                        <p>
                                            <input type="checkbox" value="meeting-room" id="meeting-room">
                                            <label for="meeting-room">Meeting Room </label>
                                        </p>
                                        <p>
                                            <input type="checkbox" value="wifi" id="wifi">
                                            <label for="wifi">Free Wifi</label>
                                        </p>
                                        <p>
                                            <input type="checkbox" value="pet" id="pet">
                                            <label for="pet">Pet Friendly</label>
                                        </p>
                                        <p>
                                            <input type="checkbox" value="parking" id="parking">
                                            <label for="parking">Parking</label>
                                        </p>
                                        <p>
                                            <input type="checkbox" value="pureair" id="pureair">
                                            <label for="pureair">Pure Air</label>
                                        </p>
                                        <p>
                                            <input type="checkbox" value="airc" id="airc">
                                            <label for="airc">Air Conditioner</label>
                                        </p>
                                        <p>
                                            <input type="checkbox" value="nosmoke" id="nosmoke">
                                            <label for="nosmoke">No Smoking</label>
                                        </p>
                                    </div>
                                </div>
                                <div class="input-wrap">
                                    <button type="submit" class="btn btn-warning filled-btn btn-block">
                                        Filter Results <i class="far fa-long-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="widget banner-widget"
                             style="background-image: url(assets/img/blog/sidebar-banner.jpg);">
                            <h2>Booking Your Latest apartment</h2>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit sed do eiusmod tempor
                                incididunt ut labore </p>
                            <a href="#" class="btn btn-warning filled-btn btn-block">BOOK NOW <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <livewire:room-card />
                        </div>
                        <div class="col-md-6">
                            <livewire:room-card />
                        </div>
                        <div class="col-md-6">
                            <livewire:room-card />
                        </div>
                        <div class="col-md-6">
                            <livewire:room-card />
                        </div>
                        <div class="col-md-6">
                            <livewire:room-card />
                        </div>
                        <div class="col-md-6">
                            <livewire:room-card />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="pagination-wrap text-center">
                                <ul class="list-inline">
                                    <li><a href="#"><i class="far fa-angle-left"></i></a></li>
                                    <li class="active"><a href="#">01</a></li>
                                    <li><a href="#">02</a></li>
                                    <li><a href="#">03</a></li>
                                    <li><a href="#"><i class="far fa-angle-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Room Section Ends -->
</div>
