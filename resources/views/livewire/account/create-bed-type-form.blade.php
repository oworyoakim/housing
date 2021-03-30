<div>
    @section('title', 'Create Bed Type')
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">Add a new bed type</h3>
                    <div class="card-tools">
                        <a href="{{route('bed-types')}}" class="btn btn-dark btn-sm"><i class="fa fa-backward"></i> Back
                            To List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" wire:model.lazy="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Name of this bed type" required>
                        @error('name')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Capacity</label>
                        <input type="number" min="1" wire:model.lazy="capacity"
                               class="form-control @error('capacity') is-invalid @enderror"
                               placeholder="Sleeps how many people?" required>
                        @error('capacity')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea wire:model.lazy="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="A description of this bed type"></textarea>
                        @error('description')<span class="error invalid-feedback">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" wire:click.prevent="createBedType" class="btn btn-warning btn-block">
                        Save <i class="far fa-save"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
