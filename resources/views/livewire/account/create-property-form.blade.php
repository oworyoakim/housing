<div>
    @section('title', 'Add New Property')
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header bg-warning">
                    <h3 class="card-title">Add a new property to start managing</h3>
                    <div class="card-tools">
                        <a href="{{route('properties')}}" class="btn btn-dark btn-sm"><i class="fa fa-backward"></i>
                            Back To List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" wire:model.lazy="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Name of this property" required>
                        @error('name')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea wire:model.lazy="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Some eye catching description of this property"></textarea>
                        @error('description')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <select wire:model="country" class="form-control select2 @error('country') is-invalid @enderror"
                                style="width: 100%;">
                            <option value="">The country this property is located in</option>
                            @foreach($countries as $ctry)
                                <option value="{{$ctry}}">{{$ctry}}</option>
                            @endforeach
                        </select>
                        @error('country')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <select wire:model="city" class="form-control select2 @error('city') is-invalid @enderror"
                                style="width: 100%;">
                            <option value="">In which city?</option>
                            @foreach($cities as $cty)
                                <option value="{{$cty}}">{{$cty}}</option>
                            @endforeach
                        </select>
                        @error('city')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Street</label>
                        <input type="text" wire:model.lazy="street"
                               class="form-control  @error('street') is-invalid @enderror"
                               placeholder="What about the street?" required>
                        @error('street')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Zip</label>
                        <input type="text" wire:model.lazy="zip"
                               class="form-control  @error('zip') is-invalid @enderror"
                               placeholder="The zip code or landmark">
                        @error('zip')<span class="error invalid-feedback">{{$message}}</span>@enderror
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
