@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Thêm tài khoản khách hàng</strong>
        </div>
        <?php
            $message = Session::get('message');
            if ($message) {
                echo "<span class='alert alert-success'>".$message."</span>";
                Session::put('message',null);
            }
        ?>
        <div class="card-body card-block">
            <form action="{{URL::to('/save-customer-admin')}}" method="POST" accept-charset="UTF-8" role="form">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên khách hàng</label></div>
                    <div class="col-12 col-md-6"><input type="text" name="name_customer" class="form-control">
                    @if($errors->has('name_customer'))
                        <p class="alert alert-danger">{{ $errors->first('name_customer') }}</p>
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
                    <div class="col-12 col-md-6"><input type="text" name="email_customer" class="form-control">
                    @if($errors->has('email_customer'))
                        <p class="alert alert-danger">{{ $errors->first('email_customer') }}</p>                  
                    @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Giới tính</label></div>
                    <div class="col-12 col-md-6">
                        <input type="radio" name="sex_customer" value="Nam">
                        <label for="male">Nam</label>&nbsp;&nbsp;
                        <input type="radio" name="sex_customer" value="Nữ">
                        <label for="female">Nữ</label>&nbsp;&nbsp;
                        <input type="radio" name="sex_customer" value="Khác">
                        <label for="female">Khác</label>
                        @if($errors->has('sex_customer'))
                            <p class="alert alert-danger">{{ $errors->first('sex_customer') }}</p>                  
                        @endif
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Mật khẩu</label></div>
                    <div class="col-12 col-md-6"><input type="password" name="password_customer" class="form-control">
                    @if($errors->has('password_customer'))
                        <p class="alert alert-danger">{{ $errors->first('password_customer') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Nhập lại mật khẩu</label></div>
                    <div class="col-12 col-md-6"><input type="password" name="password_customer_confirm" class="form-control">
                    @if($errors->has('password_customer_confirm'))
                        <p class="alert alert-danger">{{ $errors->first('password_customer_confirm') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Số điện thoại</label></div>
                    <div class="col-12 col-md-6"><input type="text" name="phone_customer" class="form-control">
                    @if($errors->has('phone_customer'))
                        <p class="alert alert-danger">{{ $errors->first('phone_customer') }}</p>                  
                    @endif</div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Địa chỉ</label></div>
                    <div class="col-12 col-md-6"><input type="text" name="address_customer" class="form-control">
                    @if($errors->has('address_customer'))
                        <p class="alert alert-danger">{{ $errors->first('address_customer') }}</p>
                    @endif</div>
                </div>            
                <div class="row form-group">
                    <input style="margin: 0px auto;" type="submit" name="" value="Thêm khách hàng" class="btn btn-primary btn-sm" onclick="return confirm('Bạn có chắc là muốn thêm tài khoản khách hàng này không?')">
                </div>
            </form>
        </div>
    </div>
    @endsection