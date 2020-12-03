@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Sửa thông tin tài khoản gian hàng</strong>
        </div>
        <?php
            $message = Session::get('message');
            if ($message) {
                echo "<span class='alert alert-success'>".$message."</span>";
                Session::put('message',null);
            }
        ?>
        <div class="card-body card-block">
            @foreach($shop as $key => $s)
            <form action="{{URL::to('/update-shop-admin/'.$s->shop_id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên gian hàng</label></div>
                    <div class="col-12 col-md-6"><input type="text" id="slug" name="shop_name" class="form-control" value="{{ $s->shop_name }}">
                    @if($errors->has('shop_name'))
                        <p class="alert alert-danger">{{ $errors->first('shop_name') }}</p>                  
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Mật khẩu</label></div>
                    <div class="col-12 col-md-6"><input type="password" name="shop_password" class="form-control" value="******">
                    @if($errors->has('shop_password'))
                        <p class="alert alert-danger">{{ $errors->first('shop_password') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Mật khẩu</label></div>
                    <div class="col-12 col-md-6"><input type="password" name="shop_password_confirm" class="form-control" value="******">
                    @if($errors->has('shop_password_confirm'))
                        <p class="alert alert-danger">{{ $errors->first('shop_password_confirm') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Số điện thoại</label></div>
                    <div class="col-12 col-md-6"><input type="text" name="shop_phone" class="form-control" value="{{ $s->shop_phone }}">
                    @if($errors->has('phone_customer'))
                        <p class="alert alert-danger">{{ $errors->first('phone_customer') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Địa chỉ</label></div>
                    <div class="col-12 col-md-6"><input type="text" name="shop_address" class="form-control" value="{{ $s->shop_address }}">
                    @if($errors->has('shop_address'))
                        <p class="alert alert-danger">{{ $errors->first('shop_address') }}</p>                  
                    @endif</div>
                </div>              
                <div class="row form-group">
                    <input style="margin: 0px auto;" type="submit" name="" value="Cập nhập tài khoản gian hàng" class="btn btn-primary btn-sm" onclick="return confirm('Bạn có chắc là muốn cập nhập tài khoản gian hàng này không ?')">
                </div>
            </form>
            @endforeach
        </div>
    </div>
    @endsection