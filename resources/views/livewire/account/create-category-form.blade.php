<div class="mt-2">
    @section('title', 'Create Room Category')
    <div class="card">
        <div class="card-header bg-secondary">
            <h3 class="card-title">Add a new category</h3>
            <div class="card-tools">
                <a href="{{route('room-categories')}}" class="btn btn-dark btn-sm"><i class="fa fa-backward"></i> Back To List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" wire:model.lazy="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name of this bed type" required>
                @error('name')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="button" wire:click.prevent="createRoomCategory" class="btn btn-warning btn-block">
                Save <i class="far fa-save"></i>
            </button>
        </div>
    </div>
</div>
