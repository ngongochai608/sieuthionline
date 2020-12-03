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
            echo "<span class='alert alert-success'>$message</span>";
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
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng kho</th>
                <th>Giá bán</th>
                <th>Đã bán</th>
                <th>Lượt xem</th>
                <th>Tình trạng</th>
                <th>Quản lý</th>
              </tr>
            </thead>
            <tbody>
             <?php
             $stt=0;
             ?>
             @foreach($shop_product as $key => $product)
             <?php
             $stt++;
             ?>
             <tr>
              <td>{{$stt}}</td>
              <td>{{$product->product_name}}</td>
              <td>
                <img src="{{('public/uploads/product/'.$product->product_image)}}" alt="" width="80" height="80" class="img-thumbnail"><br/>
                <a href="{{URL::to('/add-gallery-product-shop&'.$product->product_id)}}" class="btn btn-primary btn-sm">Thêm Gallery</a>
              </td>
              <td>{{$product->product_quantity}} sản phẩm</td>
              <td>{{number_format($product->product_price ,0,',','.')}}đ</td>
              <td>{{$product->product_sold}} sản phẩm</td>
              <td>
                  <?php
                      $view = $product->product_view;
                      if ($view!=NULL) {
                        echo "".$view." lượt xem";
                      }else{
                        echo "0 lượt xem";
                      }
                  ?>
              </td>
              <td>
                @if($product->product_status==0)
                <p class="text text-success">Đang hiển thị</p>
                @elseif($product->product_status==1)
                <p class="text text-primary">Đang chờ duyệt</p>
                @else
                <p class="text text-danger">Đã ẩn</p>
                @endif
              </td>
              <td>
                <a href="{{URL::to('/edit-product-shop&'.$product->product_id)}}" class="btn btn-success">Sửa</a>
                <a href="{{URL::to('/delete-product-shop/'.$product->product_id)}}" class="btn btn-danger" onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')">Xóa</a>
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