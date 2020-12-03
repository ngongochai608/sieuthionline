@extends('sales_layout')
@section('sales_content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Danh sách sản phẩm đang bán</h3>
          <?php
          $message = Session::get('message');
          if ($message) {
            echo "<span class='alert alert-success'>".$message."</span>";
            Session::put('message',null);
          }
          ?>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>STT</th>
                <th>Mã đơn</th>
                <th>Tên sản phẩm</th> 
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Người đặt</th>
                <th>Địa chỉ</th>
                <th>Thời gian đặt</th>
                <th>Tình trạng</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
             @php
             $i=0;
             @endphp
             @foreach($order_shop as $key => $order_s)
             @php
             $i++;
             @endphp
             <tr>
              <td>{{$i}}</td>
              <td>{{$order_s->order_code}}</td>
              <td>{{$order_s->product_name}}</td> 
              <td>{{$order_s->product_sales_quantity}}</td>
              <td>{{number_format($order_s->product_price ,0,',','.')}}đ</td>
              <td>{{$order_s->customer_name}}</td>
              <td>{{$order_s->shipping_address}}</td>
              <td>{{$order_s->create_at}}</td>
              <td>
                @if($order_s->order_status==1)
                <p style="color: red;">Đơn hàng mới</p>
                @elseif($order_s->order_status==2)
                <p style="color: blue;">Đang vận chuyển</p>
                @elseif($order_s->order_status==3)
                <p style="color: green;">Đã giao hàng</p>
                @endif
              </td>
              <td>
                @if($order_s->order_details_status==0)
                  <a href="{{URL::to('/order-access-sales/'.$order_s->order_details_id)}}" class="btn btn-success btn-sm" onclick="return confirm('Bạn có muốn xác nhận đơn hàng này không!')">Xác nhận</a>
                @elseif($order_s->order_details_status==1)
                  <p class="text text-success">Đã xác nhận</p>
                @endif
              </td>
            </tr>
            @endforeach  
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</div>
</div>

@endsection