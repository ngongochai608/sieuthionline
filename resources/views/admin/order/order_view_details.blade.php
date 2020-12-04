@extends('admin_layout')
@section('admin_content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-5">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Chi tiết đơn hàng</h1>
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
            <div class="col-sm-7">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                            <li><a href="#">Đơn hàng</a></li>
                            <li><a href="{{URL::to('/manager-order')}}">Liệt kê đơn hàng</a></li>
                            <li class="active">Chi tiết đơn hàng</li>
                        </ol>
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
                        <strong class="card-title">Thông tin tài khoản đặt hàng</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$customer->customer_name}}</td>
                                    <td>{{$customer->customer_email }}</td>
                                    <td>{{$customer->customer_phone }}</td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Thông tin giao hàng</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Kiểu thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$shipping->shipping_name}}</td>
                                    <td>{{$shipping->shipping_email}}</td>
                                    <td>{{$shipping->shipping_phone }}</td>
                                    <td>{{$shipping->shipping_address }}</td>
                                    <td>
                                        @if($shipping->shipping_method==0)
                                        Tiền mặt
                                        @else
                                        Chuyển khoản
                                        @endif
                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Sản phẩm đặt hàng</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng đặt</th>
                                    <th>Số lượng trong kho</th>
                                    <th>Gian hàng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $stt=0;
                                $total=0;
                                $phiship = 0;
                                @endphp
                                @foreach($order_details_product as $key => $order_de)
                                <tr>
                                    @php
                                    $stt++;
                                    $subtotal=$order_de->product_price*$order_de->product_sales_quantity;
                                    $total+=$subtotal;
                                    $phiship+= 15000 * $order_de->product_sales_quantity;
                                    @endphp 
                                    <td>{{$stt}}</td>
                                    <td>{{$order_de->product_name}}</td>         
                                    <td>{{number_format($order_de->product_price ,0,',','.')}}đ</td>
                                    <td>
                                        {{$order_de->product_sales_quantity }}
                                        <input type="hidden" name="product_sales_quantity" class="order_quantity_{{$order_de->product_id}}" value="{{$order_de->product_sales_quantity }}">
                                        <input type="hidden" name="order_quantity_storage" class="order_quantity_storage_{{$order_de->product_id}}" value="{{$order_de->product->product_quantity }}">
                                        <input type="hidden" name="order_product_id" class="order_product_id" value="{{$order_de->product_id}}">
                                    </td>
                                    <td>{{$order_de->product->product_quantity }}</td>
                                    <td>{{$order_de->shop_name }}</td>     
                                    <td>{{number_format($subtotal ,0,',','.')}}đ</td>
                                </tr>  
                                @endforeach
                                <tr>
                                    <td colspan="7">
                                        <span style="float: right;">
                                            Phí vận chuyển :
                                            <b style="color: blue;">{{number_format($phiship ,0,',','.')}}đ</b><br/>
                                            Tổng thanh toán :
                                            <b style="color: blue;">{{number_format($total ,0,',','.')}}đ</b>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        @foreach($order as $key => $or)
                                        @if($or->order_status==1)
                                        <form>
                                            @csrf
                                            <select class="form-control order_details">
                                                <option value="">-----------Chọn tình trạng đơn hàng----------</option>
                                                <option selected id="{{$or->order_id}}" value="1">Đơn hàng mới</option>
                                                <option id="{{$or->order_id}}" value="2">Đang giao hàng</option>
                                                <option id="{{$or->order_id}}" value="3">Đã giao hàng</option>
                                            </select>
                                        </form>
                                        @elseif($or->order_status==2)
                                        <form>
                                            @csrf
                                            <select class="form-control order_details">
                                                <option value="">-----------Chọn tình trạng đơn hàng----------</option>
                                                <option id="{{$or->order_id}}" value="1">Đơn hàng mới</option>
                                                <option selected id="{{$or->order_id}}" value="2">Đang giao hàng</option>
                                                <option id="{{$or->order_id}}" value="3">Đã giao hàng</option>
                                            </select>
                                        </form>
                                        @elseif($or->order_status==3)
                                        <form>
                                            @csrf
                                            <select class="form-control order_details">
                                                <option value="">-----------Chọn tình trạng đơn hàng----------</option>
                                                <option id="{{$or->order_id}}" value="1">Đơn hàng mới</option>
                                                <option id="{{$or->order_id}}" value="2">Đang giao hàng</option>
                                                <option selected id="{{$or->order_id}}" value="3">Đã giao hàng</option>
                                            </select>
                                        </form>
                                        @endif
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a class="btn btn-primary" style="float: right;" href="{{URL::to('/print-order/'.$order_details->order_code)}}">In đơn hàng</a>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->


<div class="clearfix"></div>
@endsection