@extends('layout')
@section('content')
<div class="single-product-area">
  <div class="container">              
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
          <strong class="lead">Đơn hàng của tôi</strong>
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table">

            @php
            $customer_name = Session::get('customer_name');
            @endphp
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