@extends('layout')
@section('content')
<div class="single-product-area">
  <div class="container">              
    <div class="row">
      <div class="col-md-12">
        <div class="card-body">
         @php
         $customer_name = Session::get('customer_name');
         @endphp
         @if($order_count==NULL)
         <div class="row cart_null">
          <div class="col-md-4">
          </div>
          <div class="col-md-4 cart_null_center">
            <p>Không có đơn hàng nào đã đặt</p>
            <a href="{{URL::to('/trangchu')}}" class="btn btn-warning">Tiếp tục mua sắp</a>
          </div>
          <div class="col-md-4">
          </div>
        </div>
        @else
        <strong class="lead">&nbsp;Đơn hàng của tôi</strong>
        <hr>
        <table id="bootstrap-data-table" class="table">
          @foreach($order_customer as $key => $order_cus)
          <thead>
            <tr>
              <th colspan="5">
                <div class="row">
                  <div class="col-md-2">
                    <p>Đơn hàng <span class="text text-primary">{{$order_cus->order_code}}</span></p>
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr style="height: 100px;">
                <td><p>Đặt ngày {{$order_cus->create_at}}</p></td>
                <td>
                  @if($order_cus->order_status==1)
                  <p class="text text-primary">Đơn hàng mới</p>
                  @elseif($order_cus->order_status==2)
                  <p class="text text-warning">Đang vận chuyển</p>
                  @elseif($order_cus->order_status==3)
                  <p class="text text-success">Đã giao hàng</p>
                  @elseif($order_cus->order_status==4)
                  <p class="text text-danger">Đã hủy đơn hàng</p>
                  @endif
                </td>
                <td>
                  @if($order_cus->order_status==1)
                  <form>
                    <button type="button" class="btn btn-danger btn-sm cancel-order" data-id="{{$order_cus->order_code}}" name="cancel-order">Hủy đơn hàng</button>
                  </form>
                  @endif
                </td>
                <td>
                  <a href="{{URL::to('/order-details-customer&'.$order_cus->order_code)}}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                </td>
                



                
                <td>

                </td>
              </tr>
              <tr>
                <td colspan="5" style="background: #f4f4f4;"></td>
              </tr>
            </tbody>
            <p></p>
            @endforeach  
          </table>
        </div>
      </div>
    </div>
    <div style="float: right;">
    @if ($order_customer->lastPage() > 1)
    <ul class="pagination">
      <li class="{{ ($order_customer->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $order_customer->url(1) }}">Quay lại</a>
      </li>
      @for ($i = 1; $i <= $order_customer->lastPage(); $i++)
      <li class="{{ ($order_customer->currentPage() == $i) ? ' active' : '' }}">
        <a href="{{ $order_customer->url($i) }}">{{ $i }}</a>
      </li>
      @endfor
      <li class="{{ ($order_customer->currentPage() == $order_customer->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $order_customer->url($order_customer->currentPage()+1) }}" >Tiếp theo</a>
      </li>
    </ul>
    @endif
    </div>

    @endif
  </div>

</div>

</div>
</div>
@endsection