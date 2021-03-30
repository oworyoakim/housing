<div>
    <div class="row">
        <div class="col-md-6">
            <div id="propertyImagesCarousel" class="carousel slide property-images mt-2 mb-5" data-ride="carousel">
                <!-- slides -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="img-fluid" src="/assets/img/blog/01.jpg" alt="Hills">
                    </div>
                    <div class="carousel-item">
                        <img class="img-fluid" src="/assets/img/blog/02.jpg" alt="Hills">
                    </div>
                </div>
                <!-- Thumbnails -->
                <ol class="carousel-indicators list-inline">
                    <li class="list-inline-item active">
                        <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#propertyImagesCarousel">
                            <img src="/assets/img/blog/01.jpg" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#propertyImagesCarousel">
                            <img src="/assets/img/blog/02.jpg" class="img-fluid"> </a>
                    </li>
                </ol>
                <a class="carousel-control-prev" href="#propertyImagesCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#propertyImagesCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="mt-5">
                <h3>{{$property->name}}</h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-2">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Rooms and Services</h3>
                    <div class="card-tools">
                        <a href="{{route('create-room-or-service', ['id' => $property->id])}}" class="btn btn-info btn-sm">
                            <i class="fa fa-plus"></i>
                            Add Room or Service
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($property->rooms as $room)
                            <div class="col-lg-6">
                                @livewire('account.room-card', ['room' => $room])
                            </div>
                        @empty
                            <div class="col-lg-12">
                                <h4>You do not have any rooms and/or services attached to this property.</h4>
                                <h4>Please add some rooms and/or services by clicking the add button above.</h4>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
