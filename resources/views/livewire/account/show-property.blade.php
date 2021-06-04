@section('title', "Property Details")
<div>
    <div class="row">
        <div class="col-md-6 shadow">
            @if($property->featured_image || $property->images->count())
                <div id="propertyImagesCarousel" class="carousel slide property-images mt-2 mb-5" data-ride="carousel">
                    <!-- slides -->
                    <div class="carousel-inner shadow">
                        @if($property->featured_image)
                            <div class="carousel-item active">
                                <img class="img-fluid"
                                     src="{{$property->featured_image->path ?? '/assets/img/blog/01.jpg'}}" alt="Hills">
                            </div>
                        @endif
                        @foreach($property->images as $index => $image)
                            <div
                                class="carousel-item @if(empty($property->featured_image) && $index == 0) active @endif">
                                <img class="img-fluid" src="{{$image->path ?? '/assets/img/blog/01.jpg'}}" alt="Hills">
                            </div>
                        @endforeach
                    </div>
                    <!-- Thumbnails -->
                    <ol class="carousel-indicators list-inline">
                        @if($property->featured_image)
                            <li class="list-inline-item active">
                                <a id="carousel-selector-0"
                                   class="selected"
                                   data-slide-to="0"
                                   data-target="#propertyImagesCarousel">
                                    <img src="{{$property->featured_image->path ?? '/assets/img/blog/01.jpg'}}"
                                         class="img-fluid">
                                </a>
                            </li>
                        @endif
                        @foreach($property->images()->unfeatured()->get() as $index => $image)
                            <li class="list-inline-item @if(empty($property->featured_image) && $index == 0) active @endif">
                                <a id="carousel-selector-{{empty($property->featured_image) ? $index : $index + 1}}"
                                   data-slide-to="{{empty($property->featured_image) ? $index : $index + 1}}"
                                   data-target="#propertyImagesCarousel">
                                    <img src="{{$image->path ?? '/assets/img/blog/02.jpg'}}" class="img-fluid">
                                </a>
                            </li>
                        @endforeach
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
            @else
                <div class="h4 mt-2">You have not uploaded any photos this property.</div>
                <div class="h4 mt-2">Use the upload area below to upload some showcase photos.</div>
            @endif
        </div>
        <div class="col-md-6 shadow">
            <div class="display-4">
                {{$property->name}}
                <a href="{{route('properties')}}" class="btn btn-dark btn-sm float-right mt-2"><i
                        class="fa fa-backward"></i>
                    Back To List</a>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h3>Address</h3>
                    <div class="row">
                        <div class="col-sm-4"><i class="fa fa-map-marker"></i> {{$property->country}}</div>
                        <div class="col-sm-4"><i class="fa fa-city"></i> {{$property->city}}</div>
                        <div class="col-sm-4"><i class="fa fa-street-view"></i> {{$property->street}}</div>
                        <div class="col-sm-4">{{$property->zip}}</div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h3>Amenities</h3>
                    <div class="row">
                        @foreach($property->amenities as $amenity)
                            <div class="col-sm-4"><i class="fa fa-wifi"></i> {{$amenity->name}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-4">
                    <a href="{{route('edit-property', ['property_id' => $property->id])}}"
                       class="btn btn-info btn-sm"><i
                            class="fa fa-edit"></i> Edit</a>
                </div>
                <div class="col-4">
                    @if($property->status == \App\Models\Property::STATUS_PENDING)
                        <button wire:click="publish()" class="btn btn-info btn-sm"><i
                                class="fa fa-thumbs-up"></i> Publish
                        </button>
                    @elseif($property->status == \App\Models\Property::STATUS_VERIFIED)
                        <button wire:click="unpublish()" class="btn btn-warning btn-sm"><i
                                class="fa fa-thumbs-down"></i> Unpublish
                        </button>
                    @else
                        <button class="btn btn-info btn-sm"><i class="fa fa-unlock"></i> Unblock</button>
                    @endif
                </div>
                <div class="col-4">

                </div>
            </div>
            <div class="row mt-4 mb-2">
                <div class="col-8">
                    <label>Additional Photos</label>
                    <input wire:model="photos" type="file" class="form-control py-5" accept="image/*" multiple>
                </div>
                <div class="col-4">
                    <button type="button"
                            wire:click.prevent="uploadAdditionalPhotos"
                            class="btn btn-outline-info mt-5"
                            @if(empty($photos)) disabled @endif>
                        <i class="fa fa-upload"></i>
                        Upload
                    </button>
                </div>
                @if (count($photos) > 0)
                    <div class="col-12">
                        @error('photos.*') <h5 class="error invalid-feedback">{{ $message }}</h5> @enderror
                        <h6>Previews</h6>
                        @foreach($photos as $photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="img-size-50 img-thumbnail m-1">
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">Rooms and Services</h3>
                    <div class="card-tools">
                        <a href="{{route('create-room-or-service', ['property_id' => $property->id])}}"
                           class="btn btn-info btn-sm">
                            <i class="fa fa-plus"></i>
                            Add Room or Service
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Rate</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($property->rooms as $room)
                            <tr>
                                <td>
                                    @if($room->featured_image)
                                        <img class="img-thumbnail img-size-64" src="{{$room->featured_image->path}}"
                                             alt="{{$room->name}}">
                                    @endif
                                </td>
                                <td>{{$room->name}}</td>
                                <td>{{$property->listing_currency_symbol}} {{number_format($room->rate)}}
                                    /{{$room->rate_period}}</td>
                                <td>
                                    <a href="{{route('show-room-or-service', ['property_id' => $room->property_id, 'room_id' => $room->id])}}"
                                       class="btn btn-info btn-sm"><i
                                            class="fa fa-eye"></i> View</a>
                                    <a href="{{route('edit-room-or-service', ['property_id' => $room->property_id, 'room_id' => $room->id])}}"
                                       class="btn btn-info btn-sm"><i
                                            class="fa fa-edit"></i> Edit</a>
                                    @if($property->status == \App\Models\Property::STATUS_VERIFIED)
                                        <button wire:click="unpublish({{$room}})" class="btn btn-warning btn-sm"><i
                                                class="fa fa-thumbs-down"></i> Unpublish
                                        </button>
                                    @else
                                        <button wire:click="publish({{$room}})" class="btn btn-info btn-sm"><i
                                                class="fa fa-thumbs-up"></i> Publish
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted small">
                                    <h4>You do not have any rooms and/or services attached to this property.</h4>
                                    <h4>Please add some rooms and/or services by clicking the add button above.</h4>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
