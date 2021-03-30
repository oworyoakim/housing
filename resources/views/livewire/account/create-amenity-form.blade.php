<div>
    @section('title', 'Create Amenity')
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header bg-warning">
                    <h3 class="card-title">Add a new property/room amenity</h3>
                    <div class="card-tools">
                        <a href="{{route('amenities')}}" class="btn btn-dark btn-sm"><i class="fa fa-backward"></i> Back
                            To List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" wire:model.lazy="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Name of this amenity" required>
                        @error('name')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea wire:model.lazy="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="A description of this amenity"></textarea>
                        @error('description')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" wire:click.prevent="createAmenity" class="btn btn-warning btn-block">
                        Save <i class="far fa-save"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
