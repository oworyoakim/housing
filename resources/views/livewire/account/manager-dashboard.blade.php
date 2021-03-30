<div>
    @section('title', 'Manager Dashboard')
    <div class="row">
        <div class="col-12 mt-2">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-hotel"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pending Properties</span>
                            <span class="info-box-number">{{$pendingPropertiesCount}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Verified Properties</span>
                            <span class="info-box-number">{{$verifiedPropertiesCount}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-lock"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Blocked Properties</span>
                            <span class="info-box-number">{{$blockedPropertiesCount}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Reservations</span>
                            <span class="info-box-number">{{number_format($reservationsAmount)}} ({{$reservationsCount}})</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-trash"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Canceled Reservations</span>
                            <span class="info-box-number">{{number_format($canceledReservationsAmount)}} ({{$canceledReservationsCount}})</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>
