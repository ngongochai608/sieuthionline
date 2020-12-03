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
                            <i class="pe-7s-cart"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?php echo $count_shipping ?></span></div>
                                <div class="stat-heading">Đơn hàng</div>
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
                            <i class="pe-7s-browser"></i>
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

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Danh sách đơn hàng mới</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Thời gian đặt</th>
                                        <th>Tình trạng</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $stt=1;
                                    @endphp
                                    @foreach($order_new as $key => $order_n)
                                    <tr>
                                        <td>{{$stt}}</td>
                                        <td>{{ $order_n->order_code }}</td>
                                        <td>{{ $order_n->create_at }}</td>
                                        <td>
                                            <?php
                                            if($order_n->order_status==1){
                                                echo "<p style='color:red;'>Đơn hàng mới</p>";
                                            }else if($order_n->order_status==2){
                                                echo "<p style='color:blue;'>Đang giao hàng</p>";
                                            }else if($order_n->order_status==3){
                                                echo "<p style='color:green;'>Đã giao hàng</p>";
                                            }
                                            ?>    
                                        </td>
                                        <td>
                                            <a href="{{URL::to('view-details-order&'.$order_n->order_code)}}" class="btn btn-success">Chi tiết</a> | 
                                            <a href="{{URL::to('')}}" class="btn btn-danger" onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')">Xóa</a>
                                        </td>
                                        @php
                                        $stt++;
                                        @endphp
                                    </tr>
                                    @endforeach    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                

            </div>
        </div><!-- .animated -->
        @endhasanyroles
    </div><!-- .content -->


    <div class="clearfix"></div>
    @endsection