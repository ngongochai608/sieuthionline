@extends('layout')
@section('content')
<div class="single-product-area">
  <div class="container">              
    <div class="row">
      <div class="col-md-12" style="padding-bottom: 70px;">

        <div class="card-body">
          <table id="bootstrap-data-table" class="table">
            <thead>
              <tr>
                <td colspan="6">
                  Xin chào <span class="text text-justify text-warning"><?php echo Session::get('customer_name'); ?></span>
                </td>
              </tr>
              <tr>
                <td colspan="6" class="lead">
                  Thông tin kiện hàng <span class="text text-primary">{{$order_code_d}}</span>
                </td>
                <td>
                    @if($order_customer->order_status==1)
                    <p class="text text-primary">Đơn hàng mới</p>
                    @elseif($order_customer->order_status==2)
                    <p class="text text-warning">Đang vận chuyển</p>
                    @elseif($order_customer->order_status==3)
                    <p class="text text-success">Đã giao hàng</p>
                    @elseif($order_customer->order_status==4)
                    <p class="text text-danger">Đã hủy đơn hàng</p>
                    @endif
                </td>
              </tr>
              <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Người bán</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @php
              $customer_name = Session::get('customer_name');
              $i=0;
              @endphp
              @foreach($order_details_customer as $key => $order_details)
              @php
              $i++;
              @endphp
              <tr>
                <td>{{$i}}</td>
                <td>{{$order_details->product_name}}</td>
                <td><img src="{{asset('public/uploads/product/'.$order_details->product->product_image)}}" width="50" height="50" class="img-thumbnail"></td>
                <td>{{number_format($order_details->product_price ,0,',','.')}}đ</td>
                <td>{{$order_details->product_sales_quantity}}</td>
                <td>{{$order_details->shop_name}}</td>
                <td>
                  @if($order_customer->order_status==3 && $order_details->comment_product!=1)
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#comment_product">Đánh giá sản phẩm</button><br/>
                  <div class="modal fade" id="comment_product" role="dialog">
                    <div class="modal-dialog modal-xs">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Hãy viết đánh giá của bạn về sản phẩm này</h4>
                        </div>
                        <div class="form-group">
                          <div class="row comment_product_feeback">
                            <div class="col-md-2">
                              <img src="{{asset('public/frontend/images/avatar_customer.png')}}" width="100%" class="img-thumbnail">
                            </div>
                            <div class="col-md-9">
                              <form>
                                @csrf
                                <div id="notify_comment"></div>
                                <div class="form-group">
                                  <?php
                                  $customer_name = Session::get('customer_name');
                                  ?>
                                  <input type="hidden" name="comment_name" class="comment_name" value="{{$customer_name}}">
                                  <input type="hidden" name="product_id" class="product_id" value="{{$order_details->product_id}}">
                                  <input type="hidden" name="order_details_id" class="order_details_id" value="{{$order_details->order_details_id}}">
                                  <textarea name="comment_content" class="form-control comment_content"></textarea>
                                  <p></p>
                                  <button type="button" class="btn btn-primary send-comment-product">Gửi đánh giá</button>
                                </div>
                              </form>                 
                            </div>
                          </div>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  @elseif($order_customer->order_status==3 && $order_details->comment_product==1)
                  <p class="text text-secondary">Đã đánh giá sản phẩm</p>
                  @endif

                  @if($order_customer->order_status==3 && $order_details->feedback!=1)
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#rating_shop">Đánh giá gian hàng</button>
                  
 
                  <div class="modal fade" id="rating_shop" role="dialog">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Đánh giá gian hàng</h4>
                        </div>
                        <div class="form-group">
                          <ul class="list-inline" title="Đánh giá sao" style="padding-left: 55px;">
                            @for($count=1;$count<=5;$count++)
                            <li title="Đánh giá sao"
                            id="{{$order_details->shop_id}}-{{$count}}" 
                            data-index="{{$count}}"
                            data-shop_id="{{$order_details->shop_id}}"
                            data-feedback_id="{{$order_details->order_details_id}}"
                            data-customer_name="{{$customer_name}}"
                            class="rating"
                            style="cursor: pointer;color:#ccc;font-size: 30px;">
                            &#9733;
                          </li>
                          @endfor
                        </ul>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  @elseif($order_customer->order_status==3 && $order_details->feedback==1)
                  <p class="text text-primary">Đã đánh giá gian hàng</p>
                  @endif
                </td>
              </tr>
              @endforeach  
            </tbody>
          </table>
          
        </div>

        <div class="card-body">
          <div class="col-md-5" style="background: #ffffff;">
            <p class="lead">Địa chỉ giao hàng</p>
            <p>Tên người nhận : {{$order_customer->shipping_name}}</p>
            <p>Số điện thoại : {{$order_customer->shipping_phone}}</p>
            <p>Địa chỉ : {{$order_customer->shipping_address}}</p>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-6" style="background: #ffffff;">
            <p class="lead">Tổng cộng</p>
            <p>Tạm tính : {{number_format($order_customer->sub_total ,0,',','.')}}đ</p>
            <p>Phí vận chuyển : {{number_format($order_customer->fee_ship ,0,',','.')}}đ</p>
            <hr>
            <p>Tổng : {{number_format($order_customer->total ,0,',','.')}}đ</p>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection