<div  class="mt-2">
    @section('title', "Create Room/Service")
    <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title">Add a new Property</h3>
            <div class="card-tools">
                <a href="{{route('view-property', ['id' => $property->id])}}" class="btn btn-dark btn-sm"><i class="fa fa-backward"></i> Back To Property</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" wire:model.lazy="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name of this property" required>
                        @error('name')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Room category</label>
                        <select wire:model="category_id" class="form-control select2 @error('category_id') is-invalid @enderror" style="width: 100%;">
                            <option value="">The room category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea wire:model.lazy="description" class="form-control @error('description') is-invalid @enderror" placeholder="Some eye catching description of this property" rows="5"></textarea>
                        @error('description')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Rate</label>
                        <input type="number" wire:model.lazy="rate" class="form-control  @error('rate') is-invalid @enderror" placeholder="How much is it?" required>
                        @error('rate')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Rate Period</label>
                        <select wire:model="rate_period" class="form-control">
                            <option value="">Rate applies per?</option>
                            @foreach($ratePeriods as $ratePeriod => $ratePeriodLabel)
                                <option value="{{$ratePeriod}}">{{$ratePeriodLabel}}</option>
                            @endforeach
                        </select>
                        @error('rate_period')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <h6 class="text-bold">Featured Photo</h6>
                        <input wire:model="photo" type="file" class="form-control" accept="image/*">
                        @error('photo') <h5 class="error invalid-feedback">{{ $message }}</h5> @enderror
                    </div>
                </div>
                <div class="col-6">
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
        </div>
        <div class="card-footer">
            <button type="button" wire:click.prevent="createRoomOrService" class="btn btn-warning btn-block">
                Save <i class="far fa-save"></i>
            </button>
        </div>
    </div>
</div>

