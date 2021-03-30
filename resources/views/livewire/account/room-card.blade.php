<div>
    <div class="card property-img">
        <img class="card-img-top" src="/assets/img/blog/02.jpg" alt="{{$room->name}}">
        <div class="card-body">
            <h3 class="card-title">{{$room->name}}</h3>
            <div class="card-text">
                <div class="my-2">{!! $room->description !!}</div>
                <div class="my-2">
                    @if($room->category)
                        <div class="small text-muted">{{$room->category->name}}</div>
                    @endif
                </div>
                <div class="my-2">
                    {{$room->price}}
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-around">
            <a href="#" title="Edit"><i class="fa fa-edit"></i></a>
            <a href="#" title="View"><i class="fa fa-eye"></i></a>
        </div>
    </div>
</div>
