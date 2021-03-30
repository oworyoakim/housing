<div>
    @section('title', 'Edit Bed Type')
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header bg-gradient-secondary">
                    <h3 class="card-title">{{$bedType->name}}</h3>
                    <div class="card-tools">
                        <a href="{{route('bed-types')}}" class="btn btn-dark btn-sm"><i class="fa fa-backward"></i> Back
                            To List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" wire:model.lazy="bedType.name"
                               class="form-control @error('bedType.name') is-invalid @enderror"
                               placeholder="Name of the bed type" required>
                        @error('bedType.name')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Capacity</label>
                        <input type="number" min="1" wire:model.lazy="bedType.capacity"
                               class="form-control @error('bedType.capacity') is-invalid @enderror"
                               placeholder="Sleeps how many people?" required>
                        @error('bedType.capacity')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea wire:model.lazy="bedType.description"
                                  class="form-control @error('bedType.description') is-invalid @enderror"
                                  placeholder="A description of the bed type"></textarea>
                        @error('bedType.description')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" wire:click.prevent="updateBedType" class="btn btn-warning btn-block">
                        Save <i class="far fa-save"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

