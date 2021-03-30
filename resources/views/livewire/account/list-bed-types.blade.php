<div>
    @section('title', 'Manage Bed Types')
    <div class="row">
        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Bed Types</h3>
                    <div class="card-tools">
                        <a href="{{route('create-bed-type')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>
                            Add Bed Type</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-sm w-100">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bedTypes as $bedType)
                            <tr>
                                <td>{{$bedType->id}}</td>
                                <td>{{$bedType->name}}</td>
                                <td>
                                    <a href="{{route('edit-bed-type', ['id' => $bedType->id])}}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
