<div>
    @section('title', 'Edit Amenity')
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header bg-gradient-secondary">
                    <h3 class="card-title">{{$amenity->name}}</h3>
                    <div class="card-tools">
                        <a href="{{route('amenities')}}" class="btn btn-dark btn-sm"><i class="fa fa-backward"></i> Back
                            To List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" wire:model.lazy="amenity.name"
                               class="form-control @error('amenity.name') is-invalid @enderror"
                               placeholder="Name of the amenity" required>
                        @error('amenity.name')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea wire:model.lazy="amenity.description"
                                  class="form-control @error('amenity.description') is-invalid @enderror"
                                  placeholder="A description of the amenity"></textarea>
                        @error('amenity.description')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" wire:click.prevent="updateAmenity" class="btn btn-warning btn-block">
                        Save <i class="far fa-save"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
