@extends('layout')
@section('content')
<div class="single-product-area">
  <div class="container">              
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
          <strong class="card-title">Sản phẩm đã đặt</strong>
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Tên sản phẩm</th>
                <th>Người bán</th>
                <th>Thời gian đặt</th>
                <th>Số lượng đặt</th>
                <th>Giá</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              @php
              $customer_name = Session::get('customer_name');
              $i=0;
              @endphp
              @foreach($order_customer as $key => $order_cus)
              @php
              $i++;
              @endphp
              <tr>
                <td>{{$i}}</td>
                <td>{{$order_cus->order_code}}</td>
                <td>{{$order_cus->product_name}}</td>
                <td>{{$order_cus->shop_name}}</td>
                <td>{{$order_cus->create_at}}</td>
                <td>{{$order_cus->product_sales_quantity}}</td>
                <td>{{number_format($order_cus->product_price ,0,',','.')}}đ</td>
                <td>
                  @if($order_cus->order_status==1)
                  <p style="color: red;">Đơn hàng mới</p>
                  @elseif($order_cus->order_status==2)
                  <p style="color: blue;">Đang vận chuyển</p>
                  @elseif($order_cus->order_status==3)
                  <p style="color: green;">Đã giao hàng</p>
                  @endif

                  @if($order_cus->order_status==3 && $order_cus->comment_product!=1)
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
                                  <input type="hidden" name="product_id" class="product_id" value="{{$order_cus->product_id}}">
                                  <input type="hidden" name="order_details_id" class="order_details_id" value="{{$order_cus->order_details_id}}">
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
                  @elseif($order_cus->order_status==3 && $order_cus->comment_product==1)
                  <p class="text text-secondary">Đã đánh giá sản phẩm</p>
                  @endif

                                    @if($order_cus->order_status==3 && $order_cus->feedback!=1)
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#rating_shop">Đánh giá gian hàng</button>
                  
                  <!-- Modal -->
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
                            id="{{$order_cus->shop_id}}-{{$count}}" 
                            data-index="{{$count}}"
                            data-shop_id="{{$order_cus->shop_id}}"
                            data-feedback_id="{{$order_cus->order_details_id}}"
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

                  <!-- End Modal -->
                  @elseif($order_cus->order_status==3 && $order_cus->feedback==1)
                  <p class="text text-primary">Đã đánh giá gian hàng</p>
                  @endif
                </td>
              </tr>
              @endforeach  
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="product-pagination text-center">
          <nav>
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>                        
        </div>
      </div>
    </div>
  </div>
</div>
@endsection