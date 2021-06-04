<div>
    @section('title', 'Add New Property')
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header bg-gradient-secondary">
                    <h3 class="card-title">Add a new property to start managing</h3>
                    <div class="card-tools">
                        <a href="{{route('properties')}}" class="btn btn-dark btn-sm"><i class="fa fa-backward"></i>
                            Back To List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" wire:model.lazy="property.name"
                                       class="form-control @error('property.name') is-invalid @enderror"
                                       placeholder="Name of this property" required>
                                @error('property.name')<span class="error invalid-feedback">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea wire:model.lazy="property.description"
                                          class="form-control @error('property.description') is-invalid @enderror"
                                          placeholder="Some eye catching description of this property" rows="5"></textarea>
                                @error('property.description')<span class="error invalid-feedback">{{$message}}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <select wire:model="property.country" class="form-control select2 @error('property.country') is-invalid @enderror"
                                        style="width: 100%;">
                                    <option value="">The country this property is located in</option>
                                    @foreach($countries as $ctry)
                                        <option value="{{$ctry->name}}">{{$ctry->name}}</option>
                                    @endforeach
                                </select>
                                @error('property.country')<span class="error invalid-feedback">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                <select wire:model="property.city" class="form-control select2 @error('property.city') is-invalid @enderror"
                                        style="width: 100%;">
                                    <option value="">In which city?</option>
                                    @foreach($cities as $cty)
                                        <option value="{{$cty->name}}">{{$cty->name}}</option>
                                    @endforeach
                                </select>
                                @error('property.city')<span class="error invalid-feedback">{{$message}}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Street</label>
                                <input type="text" wire:model.lazy="property.street"
                                       class="form-control  @error('property.street') is-invalid @enderror"
                                       placeholder="What about the street?" required>
                                @error('property.street')<span class="error invalid-feedback">{{$message}}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Zip</label>
                                <input type="text" wire:model.lazy="property.zip"
                                       class="form-control  @error('property.zip') is-invalid @enderror"
                                       placeholder="The zip code or landmark">
                                @error('zip')<span class="error invalid-feedback">{{$message}}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
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
                </div>
                <div class="card-footer">
                    <button type="button" wire:click.prevent="createProperty" class="btn btn-warning btn-block">
                        Save <i class="far fa-save"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
