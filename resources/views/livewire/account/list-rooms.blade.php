@section('title', "Manage Rooms")
<div>
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session()->get('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                    </button>
                </div>
            @endif
            <div class="card mt-2">
                <div class="card-header bg-gradient-secondary">
                    <h3 class="card-title">Rooms and Services</h3>
                    <div class="card-tools">
                        <button type="button"
                                wire:click="$emit('openModal', 'account.room-or-service-form', [])"
                                class="btn btn-info btn-sm">
                            <i class="fa fa-plus"></i>
                            Add Room or Service
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Rate</th>
                            <th>Property</th>
                            <th>Amenities</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($rooms as $room)
                            <tr>
                                <td>
                                    @if($room->featured_image)
                                        <img class="img-thumbnail img-size-64" src="{{$room->featured_image->path}}"
                                             alt="{{$room->name}}">
                                    @endif
                                </td>
                                <td>{{$room->name}}</td>
                                <td>{{$room->listing_currency_symbol}} {{number_format($room->rate)}}
                                    /{{$room->rate_period}}</td>
                                <td>{{$room->property->name ?? ''}}</td>
                                <td>{{$room->amenitiesForDisplay}}</td>
                                <td>
                                    <a href="{{route('show-room-or-service', ['property_id' => $room->property_id, 'room_id' => $room->id])}}"
                                       class="btn btn-info btn-sm"><i
                                            class="fa fa-eye"></i> View</a>
                                    <a wire:click="$emit('openModal', 'account.room-or-service-form', [{{$room->id}}])"
                                       class="btn btn-info btn-sm"><i
                                            class="fa fa-edit"></i> Edit</a>
                                    @if($room->status == \App\Models\Room::STATUS_PENDING)
                                        <button wire:click="publish({{$room}})" class="btn btn-info btn-sm"><i
                                                class="fa fa-thumbs-up"></i> Publish
                                        </button>
                                    @elseif($room->status == \App\Models\Room::STATUS_PUBLISHED)
                                        <button wire:click="unpublish({{$room}})" class="btn btn-warning btn-sm"><i
                                                class="fa fa-thumbs-down"></i> Unpublish
                                        </button>
                                    @else
                                        <button class="btn btn-info btn-sm"><i class="fa fa-unlock"></i> Unblock
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted small">
                                    <h4>You do not have any rooms and/or services attached.</h4>
                                    <h4>Please add some rooms and/or services by clicking the add button above.</h4>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <livewire:shared.fullwidth-modal title="Room/Service Form" />
        </div>
    </div>
    <script>
        Livewire.on('roomOrServiceSaved', (message) => {
            console.log(message);
        });
    </script>
</div>
