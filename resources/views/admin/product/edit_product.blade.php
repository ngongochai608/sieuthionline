@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Sửa sản phẩm</strong>
        </div>
        <?php
            $message = Session::get('message');
            if ($message) {
                echo "<span class='alert alert-success'>".$message."</span>";
                Session::put('message',null);
            }
        ?>
        <div class="card-body card-block">
            @foreach($edit_product as $key => $edit_pro)
            <form action="{{URL::to('/update-product-admin/'.$edit_pro->product_id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên sản phẩm</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="slug" name="product_name" value="{{ $edit_pro->product_name }}" class="form-control" onkeyup="ChangeToSlug();">
                    @if($errors->has('product_name'))
                        <p class="alert alert-danger">{{ $errors->first('product_name') }}</p>                  
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Hình ảnh</label></div>
                    <div class="col-12 col-md-9"><input type="file" id="file-input" name="product_image" class="form-control-file">
                    <img src="{{URL::to('public/uploads/product/'.$edit_pro->product_image)}}" height="60" width="60">
                    @if($errors->has('product_image'))
                        <p class="alert alert-danger">{{ $errors->first('product_image') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Số lượng</label></div>
                    <div class="col-12 col-md-3"><input type="text" id="email-input" name="product_quantity" value="{{ $edit_pro->product_quantity }}" class="form-control">
                    @if($errors->has('product_quantity'))
                        <p class="alert alert-danger">{{ $errors->first('product_quantity') }}</p>                  
                    @endif</div>
                </div>
                <input type="hidden" name="shop_id" value="{{ $edit_pro->shop_id }}">
                <div class="row form-group">
                    <div class="col col-md-3"><label for="password-input" class=" form-control-label">Slug</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="convert_slug" name="product_slug" value="{{ $edit_pro->product_slug }}" class="form-control">
                        @if($errors->has('product_slug'))
                        <p class="alert alert-danger">{{ $errors->first('product_slug') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Loại sản phẩm</label></div>
                    <div class="col-12 col-md-9">
                        <select name="category_id" id="select" class="form-control">

                            @foreach($category_product as $key => $cate_pro)
                            @if($cate_pro->category_id==$edit_pro->category_id)
                            <option selected value="{{ $cate_pro->category_id }}">{{ $cate_pro->category_name }}</option>
                            @else
                            <option value="{{ $cate_pro->category_id }}">{{ $cate_pro->category_name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Mô tả sản phẩm</label></div>
                    <div class="col-12 col-md-9"><textarea name="product_desc" id="ckeditor" rows="9" class="form-control">{{ $edit_pro->product_desc }}</textarea>
                    @if($errors->has('product_desc'))
                        <p class="alert alert-danger">{{ $errors->first('product_desc') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Giá</label></div>
                    <div class="col-12 col-md-4"><input type="text" id="password-input" name="product_price" value="{{ $edit_pro->product_price }}" class="form-control">
                    @if($errors->has('product_price'))
                        <p class="alert alert-danger">{{ $errors->first('product_price') }}</p>                  
                    @endif</div>*đồng
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Tình trạng</label></div>
                    <div class="col-12 col-md-3">
                        <select name="product_status" id="select" class="form-control">
                            <option value="0">Hiển thị</option>
                            <option value="1">Ẩn</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <input style="margin: 0px auto;" type="submit" name="" value="Cập nhập sản phẩm" class="btn btn-primary btn-sm" onclick="return confirm('Bạn có chắc là muốn cập nhập sản phẩm này ko?')">
                </div>
            </form>
            @endforeach
        </div>
    </div>
    @endsection