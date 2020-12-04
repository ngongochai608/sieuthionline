@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Sửa danh mục sản phẩm</strong>
        </div>
        <?php
            $message = Session::get('message');
            if ($message) {
                echo "<span class='alert alert-success'>".$message."</span>";
                Session::put('message',null);
            }
        ?>
        <div class="card-body card-block">
            @foreach($category_product as $key => $cate_pro)
            <form action="{{URL::to('/update-category-product-admin/'.$cate_pro->category_id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên danh mục</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="slug" name="category_product_name" placeholder="Từ 10 đến 50 ký tự*" class="form-control" value="{{ $cate_pro->category_name }}" onkeyup="ChangeToSlug();">
                    @if($errors->has('category_product_name'))
                        <p class="alert alert-danger">{{ $errors->first('category_product_name') }}</p>                  
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Slug</label></div>
                    <div class="col-12 col-md-9"><input type="text" name="category_product_slug" value="{{ $cate_pro->category_slug_product }}" class="form-control" id="convert_slug">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Hình ảnh danh mục</label></div>
                    <div class="col-12 col-md-9"><input type="file" id="file-input" name="category_product_image" class="form-control"> 
                    <img src="{{URL::to('public/uploads/category_product/'.$cate_pro->category_image)}}" height="60" width="60">
                    @if($errors->has('category_product_image'))
                        <p class="alert alert-danger">{{ $errors->first('category_product_image') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Mô tả danh mục</label></div>
                    <div class="col-12 col-md-9"><textarea name="category_product_desc" class="form-control" id="ckeditor">{{ $cate_pro->category_desc }}</textarea> 
                    @if($errors->has('category_product_desc'))
                        <p class="alert alert-danger">{{ $errors->first('category_product_desc') }}</p>
                    @endif</div>
                </div>  
                <div class="row form-group">
                    <input style="margin: 0px auto;" type="submit" name="" value="Cập nhập loại sản phẩm" class="btn btn-primary btn-sm" onclick="return confirm('Bạn có chắc là muốn cập nhập danh mục sản phẩm này không ?')">
                </div>
            </form>
            @endforeach
        </div>
    </div>
    @endsection