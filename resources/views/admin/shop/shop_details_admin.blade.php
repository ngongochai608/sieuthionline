@extends('admin_layout')
@section('admin_content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Chi tiết gian hàng</strong>
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo "<span class='alert alert-success'>".$message."</span>";
                            Session::put('message',null);
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row info-shop_details">
                                    <div class="col-md-1">
                                        <img src="public/sales/images/store.png" width="100%" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-2">
                                        <p style="font-size: 1rem;">{{$shop_details->shop_name}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>Đánh giá : <i style="color: orange;">{{$count_rating_shop}}</i></p>
                                        <p>Sản phẩm đang bán : <i style="color: orange;">{{$count_product_shop}}</i></p>
                                        <p>Ngày đăng ký : <i style="color: orange;">{{$shop_details->create_at}}</i></p>
                                    </div>
                                    <div class="col-md-5">
                                        <p>Chủ gian hàng : <i style="color: orange;"> {{$shop_details->name_shop_owner}}</i></p>                                        
                                        <p>Số điện thoại : <i style="color: orange;"> {{$shop_details->shop_phone}}</i></p>
                                        <p>Địa chỉ : <i style="color: orange;"> {{$shop_details->shop_address}}</i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Sản phẩm đang bán</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Giá</th>
                                    <th>Danh mục</th>
                                    <th>Lượt xem</th>
                                    <th>Đã bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product_shop as $key => $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td><img src="{{asset('public/uploads/product/'.$product->product_image)}}" width="50" height="50" class="img-thumbnail"></td>
                                    <td>{{number_format($product->product_price ,0,',','.')}}đ</td>
                                    <td>{{ $product->category_name }}</td>
                                    <td>{{ $product->product_view }}</td>
                                    <td>{{ $product->product_sold }}</td>
                                </tr>
                                    @endforeach    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    @endsection