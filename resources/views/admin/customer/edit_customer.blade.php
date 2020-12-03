@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Sửa thông tin tài khoản Customer</strong>
        </div>
        <?php
            $message = Session::get('message');
            if ($message) {
                echo "<span class='alert alert-success'>".$message."</span>";
                Session::put('message',null);
            }
        ?>
        <div class="card-body card-block">
            @foreach($customer as $key => $c)
            <form action="{{URL::to('/update-customer-admin/'.$c->customer_id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên khách hàng</label></div>
                    <div class="col-12 col-md-6"><input type="text" id="slug" name="name_customer" class="form-control" value="{{ $c->customer_name }}">
                    @if($errors->has('name_customer'))
                        <p class="alert alert-danger">{{ $errors->first('name_customer') }}</p>                  
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
                    <div class="col-12 col-md-6"><input type="text" name="email_customer" class="form-control" value="{{ $c->customer_email }}">
                    @if($errors->has('email_customer'))
                        <p class="alert alert-danger">{{ $errors->first('email_customer') }}</p>                  
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Mật khẩu</label></div>
                    <div class="col-12 col-md-6"><input type="password" name="password_customer" class="form-control" value="******">
                    @if($errors->has('password_customer'))
                        <p class="alert alert-danger">{{ $errors->first('password_customer') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Số điện thoại</label></div>
                    <div class="col-12 col-md-6"><input type="text" name="phone_customer" class="form-control" value="{{ $c->customer_phone }}">
                    @if($errors->has('phone_customer'))
                        <p class="alert alert-danger">{{ $errors->first('phone_customer') }}</p>                  
                    @endif</div>
                </div>           
                <div class="row form-group">
                    <input style="margin: 0px auto;" type="submit" name="" value="Cập nhập tài khoản customer" class="btn btn-primary btn-sm" onclick="return confirm('Bạn có chắc là muốn cập nhập tài khoản customer này không ?')">
                </div>
            </form>
            @endforeach
        </div>
    </div>
    @endsection