@extends('layout')
@section('content')
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        @if(Session::get('cart')==true)
        <div class="row cart">   
            <div class="col-md-8">
                <?php
                $message_error = Session::get('message_error');
                $message = Session::get('message');
                if ($message) {
                    echo "<span class='alert alert-success'>$message</span>";
                    Session::put('message',null);
                }
                if ($message_error) {
                    echo "<span class='alert alert-danger'>$message_error</span>";
                    Session::put('message_error',null);
                }
                ?>
                <div class="single-sidebar">
                 <form method="post" action="{{URL::to('/update-cart')}}">
                    @csrf
                    <table cellspacing="0" class="table">
                        <thead>
                            <tr>                               
                                <th>&nbsp;</th>
                                <th>Tên sản phẩm</th>
                                <th class="product-price">Giá</th>
                                <th class="product-quantity">Số lượng</th>
                                <th class="product-subtotal">Tổng</th>
                                <th class="product-remove">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total = 0;
                            $phiship = 0;
                            @endphp
                            @foreach(Session::get('cart') as $key => $cart)
                            @php
                            $subtotal = $cart['product_price']*$cart['product_qty'];
                            $total+=$subtotal;
                            $phiship+= 15000 * $cart['product_qty'];
                            @endphp
                            <tr class="cart_item">                          
                                <td class="product-thumbnail">
                                    <a href="#"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{'public/uploads/product/'.$cart['product_image']}}"></a>
                                </td>

                                <td class="product-name">
                                    <a href="{{url('/chi-tiet-san-pham&'.$cart['product_slug'].'&'.$cart['shop_id'].'&dm='.$cart['product_category'])}}">{{$cart['product_name']}}</a> 
                                </td>

                                <td class="product-price">
                                    <span class="amount" style="color: red;">{{number_format($cart['product_price'],0,',','.')}}đ</span> 
                                </td>
                                <td class="product-quantity">
                                    <div class="quantity buttons_added">
                                        <input type="number" size="4" class="cart_quantity_" value="{{$cart['product_qty']}}" name="cart_qty[{{$cart['session_id']}}]" min="1" step="1">
                                    </div>
                                </td>
                                <input type="hidden" name="product_qty_store[{{$cart['session_id']}}]" class="product_qty_store_" value="{{$cart['product_quantity_store']}}">
                                <td class="product-subtotal">
                                    <span class="amount">{{number_format($subtotal,0,',','.')}}đ</span> 
                                </td>
                                <td class="product-remove">
                                    <a title="Xóa sản phẩm này" class="remove" href="{{URL::to('delete-product-cart/'.$cart['session_id'])}}" onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này khỏi giỏ hàng không?')" class="btn btn-danger"><i class="fa fa-trash-o"></i></a> 
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="6">
                                    <input type="submit" style="float: right;" class="btn btn-default btn-sm" value="Cập nhập" name="update_qty">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>   
        </div>

        <div class="col-md-4">
            <div class="cart-right">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <div class="cart-collaterals">
                            <div class="sumary_header">
                                Thông tin đơn hàng
                            </div>
                            <div class="row">
                                <p class="col-md-6" style="color: #757575;">Tạm tính :</p>
                                <p class="col-md-6" style="text-align: right;">{{number_format($total,0,',','.')}}đ</p>   
                            </div>
                            <div class="row">
                                <p class="col-md-6" style="color: #757575;">Phí giao hàng :</p>
                                <p class="col-md-6" style="text-align: right;">{{number_format($phiship,0,',','.')}}đ</p>   
                            </div>      
                            <div class="row">
                                <p class="col-md-6">Tổng cộng :</p>
                                <b class="col-md-6" style="text-align: right;color: #5a88ca">{{number_format($total + $phiship,0,',','.')}}đ</b>   
                            </div>
                            <div class="row">
                                <form>
                                <div class="col-md-8">
                                    <input type="" name="" placeholder="Mã giảm giá" class="form-control" style="    width: 233px;">
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" class="btn btn-sm" value="Áp dụng" style="padding: 8px 18px;">
                                </div>
                                </form>
                            </div>
                            @if (Session::get('customer_id'))
                            <a class="btn btn-success btn-sm btn-block" href="{{URL::to('/thanhtoan')}}">Xác nhận đơn hàng</a>
                            @else
                            <a class="btn btn-success btn-sm btn-block" href="{{URL::to('/login-customer')}}">Xác nhận đơn hàng</a>
                            @endif
                        </div>
                    </div>                        
                </div>
            </div>                 
        </div>

        @else

        <div class="row cart_null">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 cart_null_center">
                <p>Không có sản phẩm nào trong giỏ hàng</p>
                <a href="{{URL::to('/trangchu')}}" class="btn btn-warning">Tiếp tục mua sắp</a>
            </div>
            <div class="col-md-4">
            </div>
        </div>

    @endif

</div>
</div>
</div>
@endsection