@extends('admin_layout')
@section('admin_content')
<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-12">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Liệt kê đơn hàng</h1>
                                <?php
                                $message = Session::get('message');
                                if ($message) {
                                    echo "<span class='alert alert-success'>".$message."</span>";
                                    Session::put('message',null);
                                }
                                ?>
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
                                <strong class="card-title">Liệt kê đơn hàng</strong>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-striped table-bordered">
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
                                        @foreach($order as $key => $ord)
                                        <tr>
                                            <td>{{$stt}}</td>
                                            <td>{{ $ord->order_code }}</td>
                                            <td>{{ $ord->create_at }}</td>
                                            <td>
                                            <?php
                                            if($ord->order_status==1){
                                                echo "<p class='text text-primary'>Đơn hàng mới</p>";
                                            }else if($ord->order_status==2){
                                                echo "<p class='text text-warning'>Đang giao hàng</p>";
                                            }else if($ord->order_status==3){
                                                echo "<p class='text text-success'>Đã giao hàng</p>";
                                            }else if($ord->order_status==4){
                                                echo "<p class='text text-danger'>Đơn đã hủy</p>";
                                            }
                                            ?>    
                                            </td>
                                            <td>
                                                <a href="{{URL::to('view-details-order&'.$ord->order_code)}}" class="btn btn-success">Chi tiết</a> | 
                                                <a href="{{URL::to('delete-order-admin&'.$ord->order_code)}}" class="btn btn-danger" onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này không?')">Xóa</a>
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
        </div><!-- .content -->


        <div class="clearfix"></div>
@endsection