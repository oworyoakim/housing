<div>
    @section('title', 'Manage Amenities')
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Amenities</h3>
                    <div class="card-tools">
                        <a href="{{route('create-amenity')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add Amenity</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-sm w-100">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($amenities as $amenity)
                            <tr>
                                <td>{{$amenity->id}}</td>
                                <td>{{$amenity->name}}</td>
                                <td>{{$amenity->description}}</td>
                                <td>
                                    <a href="{{route('edit-amenity', ['id' => $amenity->id])}}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="float-right">
                        {{ $amenities->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
