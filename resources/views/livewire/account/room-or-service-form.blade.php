<div class="mx-lg-5">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Name</label>
                <input type="text" wire:model.lazy="room.name" class="form-control @error('room.name') is-invalid @enderror" placeholder="Name of this property" required>
                @error('room.name')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Property</label>
                <select wire:model="room.property_id" class="form-control @error('room.property_id') is-invalid @enderror">
                    <option value="">Select...</option>
                    @foreach($properties as $property)
                        <option value="{{$property->id}}">{{$property->name}}</option>
                    @endforeach
                </select>
                @error('room.property_id')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Room category</label>
                <select wire:model="room.category_id" class="form-control select2 @error('room.category_id') is-invalid @enderror" style="width: 100%;">
                    <option value="">The room category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('room.category_id')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Rate</label>
                <input type="number" wire:model.lazy="room.rate" class="form-control  @error('room.rate') is-invalid @enderror" placeholder="How much is it?" required>
                @error('room.rate')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Rate Period</label>
                <select wire:model="room.rate_period" class="form-control @error('room.rate_period') is-invalid @enderror">
                    <option value="">Rate applies per?</option>
                    @foreach($ratePeriods as $ratePeriod => $ratePeriodLabel)
                        <option value="{{$ratePeriod}}">{{$ratePeriodLabel}}</option>
                    @endforeach
                </select>
                @error('room.rate_period')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <h6 class="text-bold">Featured Photo</h6>
                <input wire:model="photo" type="file" class="form-control" accept="image/*">
                @error('photo') <h5 class="error invalid-feedback">{{ $message }}</h5> @enderror
            </div>
        </div>
        <div class="col-4">
            @if($room->featured_image)
                <img src="{{$room->featured_image->path}}" class="img-fluid mt-3" height="100"
                     width="100">
            @endif
        </div>
        <div class="col-4">
            @if($photo)
                <div class="text-bold">Preview thumbnail</div>
                <img src="{{ $photo->temporaryUrl() }}" class="img-size-64 shadow">
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h6 class="text-bold">Amenities</h6>
                @foreach($amenitiesOptions as $amenity)
                    <div class="form-check-inline col-lg-3 col-md-4 col-sm-6">
                        <input type="checkbox" wire:model="amenities" class="form-check-input"
                               value="{{$amenity->id}}" multiple>
                        <div class="form-check-label ml-2">{{$amenity->name}}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Description</label>
                <textarea wire:model.lazy="room.description" class="form-control @error('room.description') is-invalid @enderror" placeholder="Some eye catching description of this property" rows="5"></textarea>
                @error('room.description')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <button type="button" wire:click.prevent="updateRoomOrService" class="btn btn-warning btn-lg btn-block">
                Save <i class="far fa-save"></i>
            </button>
        </div>
    </div>
</div>
