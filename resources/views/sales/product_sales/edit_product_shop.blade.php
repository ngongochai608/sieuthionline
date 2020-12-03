@extends('sales_layout')
@section('sales_content')
<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Sửa thông tin sản phẩm</h3>
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
        <form action="{{URL::to('/update-product-shop/'.$edit_product->product_id)}}" method="post" enctype="multipart/form-data" accept-charset="UTF-8" role="form">
          {{ @csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Tên sản phẩm</label>
              <input type="text" id="slug" name="product_name" value="{{ $edit_product->product_name }}" class="form-control" onkeyup="ChangeToSlug();">
              @if($errors->has('product_name'))
              <p class="alert alert-danger">{{ $errors->first('product_name') }}</p>                  
              @endif
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Slug</label>
              <input type="text" id="convert_slug" name="product_slug" value="{{ $edit_product->product_slug }}" class="form-control">
              @if($errors->has('product_slug'))
              <p class="alert alert-danger">{{ $errors->first('product_slug') }}</p>    
              @endif
            </div>
            <div class="form-group">
              <label for="disabled-input" class=" form-control-label">Hình ảnh</label>
              <input type="file" id="file-input" name="product_image" class="form-control-file">
              <img src="{{URL::to('public/uploads/product/'.$edit_product->product_image)}}" height="60" width="60">
              @if($errors->has('product_image'))
              <p class="alert alert-danger">{{ $errors->first('product_image') }}</p>
              @endif
            </div>
            <div class="form-group">
              <label for="disabled-input" class=" form-control-label">Loại sản phẩm</label>
              <select name="category_id" id="select" class="form-control">
                @foreach($category_product as $key => $cate_pro)
                @if($cate_pro->category_id==$edit_product->category_id)
                <option selected value="{{ $cate_pro->category_id }}">{{ $cate_pro->category_name }}</option>
                @else
                <option value="{{ $cate_pro->category_id }}">{{ $cate_pro->category_name }}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Số lượng</label>
              <input type="text" id="email-input" name="product_quantity" value="{{ $edit_product->product_quantity }}" class="form-control">
              @if($errors->has('product_quantity'))
              <p class="alert alert-danger">{{ $errors->first('product_quantity') }}</p>           
              @endif
            </div>
            <div class="form-group">
              <label for="disabled-input" class=" form-control-label">Mô tả</label>
              <textarea name="product_desc" id="ckeditor" rows="9" class="form-control">{{ $edit_product->product_desc }}</textarea>
              @if($errors->has('product_desc'))
              <p class="alert alert-danger">{{ $errors->first('product_desc') }}</p>               
              @endif
            </div>
            <div class="form-group">
              <label for="disabled-input" class=" form-control-label">Giá</label><input type="text" id="password-input" name="product_price" value="{{ $edit_product->product_price }}" class="form-control">*đồng
              @if($errors->has('product_price'))
              <p class="alert alert-danger">{{ $errors->first('product_price') }}</p>
              @endif
            </div>
            <input type="hidden" name="product_status">
            <?php
            $shop_id = Session::get('shop_id');
            ?>
            <input type="hidden" name="shop_id" value="<?php echo $shop_id ?>">
            <input type="hidden" name="product_sold" value="{{ $edit_product->product_sold }}">
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <input type="submit" name="" class="btn btn-warning" value="Cập nhập sản phẩm" onclick="return confirm('Bạn có chắc là muốn cập nhập sản phẩm này không?')">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection