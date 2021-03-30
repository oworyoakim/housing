<div  class="mt-2">
    <div class="card">
        <div class="card-header bg-warning">
            <h3 class="card-title">Add a new Property</h3>
            <div class="card-tools">
                <a href="{{route('view-property', ['id' => $property->id])}}" class="btn btn-dark btn-sm"><i class="fa fa-backward"></i> Back To Property</a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <input type="text" wire:model.lazy="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name of this property" required>
                @error('name')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
                <textarea wire:model.lazy="description" class="form-control @error('description') is-invalid @enderror" placeholder="Some eye catching description of this property"></textarea>
                @error('description')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
                <select wire:model="category_id" class="form-control select2 @error('category_id') is-invalid @enderror" style="width: 100%;">
                    <option value="">The room category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
                <input type="number" wire:model.lazy="price" class="form-control  @error('price') is-invalid @enderror" placeholder="How much is it?" required>
                @error('price')<span class="error invalid-feedback">{{$message}}</span>@enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="button" wire:click.prevent="createRoomOrService" class="btn btn-warning btn-block">
                Save <i class="far fa-save"></i>
            </button>
        </div>
    </div>
</div>

