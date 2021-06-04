<div>
    @section('title', 'Manage Properties')
    <div class="row">
        <li class="col-12 table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Rooms/Services</th>
                    <th>Amenities</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($properties as $property)
                    <tr>
                        <td>
                            @if($property->featured_image)
                                <img width="80" src="{{$property->featured_image->path}}" class="img-fluid"/>
                            @endif
                        </td>
                        <td>{{$property->name}}</td>
                        <td>{{$property->rooms()->count()}}</td>
                        <td>{{$property->amenitiesForDisplay}}</td>
                        <td>
                            <a href="{{route('view-property', ['property_id' => $property->id])}}"
                               class="btn btn-info btn-sm"><i
                                    class="fa fa-eye"></i> View</a>
                            <a href="{{route('edit-property', ['property_id' => $property->id])}}"
                               class="btn btn-info btn-sm"><i
                                    class="fa fa-edit"></i> Edit</a>
                            @if($property->status == \App\Models\Property::STATUS_PENDING)
                                <button wire:click="publish({{$property}})" class="btn btn-info btn-sm"><i
                                        class="fa fa-thumbs-up"></i> Publish
                                </button>
                            @elseif($property->status == \App\Models\Property::STATUS_VERIFIED)
                                <button wire:click="unpublish({{$property}})" class="btn btn-warning btn-sm"><i
                                        class="fa fa-thumbs-down"></i> Unpublish
                                </button>
                            @else
                                <button class="btn btn-info btn-sm"><i class="fa fa-unlock"></i> Unblock</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="h2 my-2">You do not have any properties added to your account.</div>
                            <div class="h2 my-2">To create your properties, click the plus button at the bottom to get
                                started!
                            </div>
                            <div class="text-center text-warning">
                                <i class="fa fa-arrow-down fa-5x"></i>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-5">
                {{ $properties->appends(request()->except('page'))->links() }}
            </div>
    </div>
</div>
<a href="{{route('create-property')}}" class="btn-float">
    <i class="fa fa-plus btn-float-icon"></i>
</a>
</div>
