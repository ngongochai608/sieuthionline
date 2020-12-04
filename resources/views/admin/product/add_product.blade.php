@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Thêm sản phẩm</strong>
        </div>
        <?php
            $message = Session::get('message');
            if ($message) {
                echo "<span class='alert alert-success'>".$message."</span>";
                Session::put('message',null);
            }
        ?>
        <div class="card-body card-block">
            <form action="{{URL::to('/save-product-admin')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên sản phẩm</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="slug" name="product_name" placeholder="Từ 6 đến 200 ký tự*" class="form-control" onkeyup="ChangeToSlug();">
                    @if($errors->has('product_name'))
                        <p class="alert alert-danger">{{ $errors->first('product_name') }}</p>                  
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Hình ảnh</label></div>
                    <div class="col-12 col-md-9"><input type="file" id="file-input" name="product_image" class="form-control-file">
                    @if($errors->has('product_image'))
                        <p class="alert alert-danger">{{ $errors->first('product_image') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Số lượng</label></div>
                    <div class="col-12 col-md-3"><input type="text" id="email-input" name="product_quantity" placeholder="Nhập ký tự số*" class="form-control">
                    @if($errors->has('product_quantity'))
                        <p class="alert alert-danger">{{ $errors->first('product_quantity') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="password-input" class=" form-control-label">Slug</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="convert_slug" name="product_slug" placeholder="Từ 6 đến 200 ký tự*" class="form-control">
                     @if($errors->has('product_slug'))
                        <p class="alert alert-danger">{{ $errors->first('product_slug') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Loại sản phẩm</label></div>
                    <div class="col-12 col-md-9">
                        <select name="category_id" id="select" class="form-control">
                            @foreach($category_product as $key => $category_pro)
                            <option value="{{ $category_pro->category_id }}">{{ $category_pro->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="shop_id" value="11">
                <div class="row form-group">
                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Mô tả sản phẩm</label></div>
                    <div class="col-12 col-md-9"><textarea name="product_desc" id="ckeditor" rows="9" placeholder="Mô tả sản phẩm...*" class="form-control"></textarea>
                    @if($errors->has('product_desc'))
                        <p class="alert alert-danger">{{ $errors->first('product_desc') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Giá</label></div>
                    <div class="col-12 col-md-4"><input type="text" id="password-input" name="product_price" placeholder="Giá sản phẩm*" class="form-control">
                    @if($errors->has('product_price'))
                        <p class="alert alert-danger">{{ $errors->first('product_price') }}</p>                  
                    @endif</div>*đồng
                </div>
                <input type="hidden" name="product_status" value="0">
                <div class="row form-group">
                    <input style="margin: 0px auto;" type="submit" name="" value="Thêm sản phẩm" class="btn btn-primary btn-sm">
                </div>
            </form>
        </div>
    </div>
    @endsection