@extends('admin_layout')
@section('admin_content')

<div class="animated fadeIn">
    <!-- Widgets  -->
    @hasanyroles(['admin','author','logistics'])
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <i class="fa fa-gift"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?php echo $count_product ?></span></div>
                                <div class="stat-heading">Sản phẩm</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-2">
                            <i class="fa fa-bars"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?php echo $count_category ?></span></div>
                                <div class="stat-heading">Danh mục</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-3">
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?php echo $count_shop ?></span></div>
                                <div class="stat-heading">Gian hàng</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-4">
                            <i class="pe-7s-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?php echo $count_customer ?></span></div>
                                <div class="stat-heading">Khách hàng</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-5">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?php echo $count_author ?></span></div>
                                <div class="stat-heading">Nhân viên quản lý nội dung</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-6">
                            <i class="fa fa-user-circle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?php echo $count_logictis ?></span></div>
                                <div class="stat-heading">Nhân viên quản lý đơn hàng</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib" style="color: #8FB9A8;">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?php echo $count_shop ?></span></div>
                                <div class="stat-heading">Đơn hàng thành công tháng này</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib" style="color: #801336;">
                            <i class="fa fa-area-chart"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?php echo $count_customer ?></span></div>
                                <div class="stat-heading">Doanh thu tháng này</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Thống kê</strong>
                        </div>
                        <div class="card-body">
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
                </div>
            </div>
        </div>
        

    </div>
</div><!-- .animated -->
@endhasanyroles
</div><!-- .content -->


<div class="clearfix"></div>
@endsection