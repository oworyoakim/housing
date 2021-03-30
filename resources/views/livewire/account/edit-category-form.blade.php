<div class="mt-2">
    @section('title', 'Edit Room Category')
    <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title">{{$category->name}}</h3>
            <div class="card-tools">
                <a href="{{route('room-categories')}}" class="btn btn-dark btn-sm"><i class="fa fa-backward"></i> Back To List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" wire:model.lazy="category.name" class="form-control @error('category.name') is-invalid @enderror" placeholder="Name of the category" required>
                @error('category.name')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="button" wire:click.prevent="updateRoomCategory" class="btn btn-warning btn-block">
                Save <i class="far fa-save"></i>
            </button>
        </div>
    </div>
</div>
