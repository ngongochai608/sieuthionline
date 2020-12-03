@extends('sales_layout')
@section('sales_content')
<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Thêm sản phẩm mới</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $message = Session::get('message');
        if($message){
          echo "<p class='alert alert-success'>".$message."</p>";
          Session::put('message',null);
        }
        ?>
        <form action="{{URL::to('/post-product-shop')}}" method="post" enctype="multipart/form-data" accept-charset="UTF-8" role="form">
          {{ @csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Tên sản phẩm</label>
              <input type="text" class="form-control" name="product_name" id="slug" onkeyup="ChangeToSlug();">
              @if($errors->has('product_name'))
              <p class="alert alert-danger">{{ $errors->first('product_name') }}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Slug</label>
              <input type="text" class="form-control" name="product_slug" id="convert_slug">
              @if($errors->has('product_slug'))
              <p class="alert alert-danger">{{ $errors->first('product_slug') }}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="disabled-input" class=" form-control-label">Hình ảnh</label>
              <input type="file" name="product_image" class="form-control">@if($errors->has('product_image'))
              <p class="alert alert-danger">{{ $errors->first('product_image') }}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="disabled-input" class=" form-control-label">Loại sản phẩm</label>
              <select name="category_id" id="select" class="form-control">
                @foreach($category_product as $key => $category_pro)
                <option value="{{ $category_pro->category_id }}">{{ $category_pro->category_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Số lượng</label>
              <input min="1" type="text" name="product_quantity" class="form-control">
              @if($errors->has('product_quantity'))
              <p class="alert alert-danger">{{ $errors->first('product_quantity') }}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="disabled-input" class=" form-control-label">Mô tả</label><textarea name="product_desc" class="form-control" id="ckeditor"></textarea>@if($errors->has('product_desc'))
              <p class="alert alert-danger">{{ $errors->first('product_desc') }}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="disabled-input" class=" form-control-label">Giá</label><input type="text" name="product_price" class="form-control">@if($errors->has('product_price'))
              <p class="alert alert-danger">{{ $errors->first('product_price') }}</p>
              @endif
            </div>
            <?php
            $shop_id = Session::get('shop_id');
            ?>
            <input type="hidden" name="shop_id" value="<?php echo $shop_id ?>">
            <input type="hidden" name="product_sold" value="0">
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <input type="submit" name="register_customer" class="btn btn-warning" value="Đăng sản phẩm">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection