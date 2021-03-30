<div class="my-2">
    <!-- Single Room -->
    @if(!empty($property))
        <div class="card elevation-1">
            <div class="property-img">
                <img class="card-img-top" src="/assets/img/rooms/10.jpg" alt="Room">
                @if(!empty($property->description))
                    <div class="overlay">
                        <h2>{{$property->description}}</h2>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <h4>{{$property->name}}</h4>
                <ul class="list-inline">
                    <li class="list-inline-item">{{$property->rooms()->count()}} Rooms / Services</li> |
                    <li class="list-inline-item">Swimming pool</li> |
                    <li class="list-inline-item">Pool table</li> |
                    <li class="list-inline-item">Steam bath</li> |
                    <li class="list-inline-item">Spa</li>
                </ul>
                <div class="mt-2 mr-2">
                    <a href="{{route('view-property', ['id' => $property->id])}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>
                    <a href="{{route('edit-property', ['id' => $property->id])}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    @if($property->status == \App\Models\Property::STATUS_PENDING)
                        <button wire:click="publish"  class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i> Publish</button>
                    @elseif($property->status == \App\Models\Property::STATUS_VERIFIED)
                        <button wire:click="unpublish" class="btn btn-warning btn-sm"><i class="fa fa-thumbs-down"></i> Unpublish</button>
                    @else
                        <button class="btn btn-info btn-sm"><i class="fa fa-unlock"></i> Unblock</button>
                    @endif
                </div>
            </div>
        </div>
@endif
<!-- Single Room -->
</div>
