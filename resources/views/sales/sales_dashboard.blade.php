@extends('sales_layout')
@section('sales_content')
	<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$count_shipping}}</h3>

                <p>Đơn hàng mới</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{URL::to('/order-shop')}}" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$count_product}}</h3>

                <p>Sản phẩm đang bán</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{URL::to('/all-product-shop')}}" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$shop->shop_view}}</h3>

                <p>Lượt truy cập gian hàng</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$product_sold_count}}</h3>

                <p>Sản phẩm đã bán</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <p>Thống kê doanh số</p>
            <form autocomplete="off">
              @csrf
              <div class="row">
              <div class="col-md-3">
                <p>Từ ngày <input type="text" id="datepicker" class="form-control"></p>
              </div>
              <div class="col-md-3">
                <p>Đến ngày <input type="text" id="datepicker2" class="form-control"></p>
              </div>
              <div class="col-md-2">
                <input type="button" id="btn-dashboard-filter" style="margin-top: 27px;" class="btn btn-primary btn-sm btn-block" value="Xem kết quả">
              </div>
              <div class="col-md-2">
                  <p>Lọc theo: 
                      <select class="dashboard-filter form-control">
                        <option>--Chọn--</option>
                        <option value="7ngay">7 Ngày trước đến nay</option>
                        <option value="thangtruoc">Tháng trước</option>
                        <option value="thangnay">Tháng này</option>
                        <option value="365ngayqua">365 ngày qua</option>
                      </select>
                  </p>
              </div>
              </div>
            </form>

            <div class="col-md-12">
                <div id="chart" style="height: 250px;"></div>
            </div>
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
@endsection