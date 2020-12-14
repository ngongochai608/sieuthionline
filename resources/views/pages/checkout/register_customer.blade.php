@extends('layout')
@section('content')
<style type="text/css">
    .login-form{
        padding-top: 50px;
        padding-bottom: 120px;
    }
</style>
<div class="container login-form">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Đăng ký tài khoản khách hàng</h3>
                </div>
                <div class="panel-body">
                    <?php 
                    $message = Session::get('message');
                    if ($message) {
                        echo '<p class="alert alert-success">'.$message.'</p>';
                        Session::put('message',null);
                    }
                    ?>
                    <form action="{{URL::to('/sigin-customer')}}" method="POST" accept-charset="UTF-8" role="form">
                        {{ @csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                <input type="text" style="margin-top: 10px;" name="name_customer" placeholder="Họ tên" class="form-control">
                                @if($errors->has('name_customer'))
                                <p class="alert alert-danger">{{ $errors->first('name_customer') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" name="email_customer" placeholder="Email" class="form-control">
                                @if($errors->has('email_customer'))
                                <p class="alert alert-danger">{{ $errors->first('email_customer') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="radio" name="sex_customer" value="Nam">
                                <label>Nam</label>&nbsp;&nbsp;
                                <input type="radio" name="sex_customer" value="Nữ">
                                <label>Nữ</label>&nbsp;&nbsp;
                                <input type="radio" name="sex_customer" value="Khác">
                                <label>Khác</label>&nbsp;&nbsp;
                                @if($errors->has('sex_customer'))
                                <p class="alert alert-danger">{{ $errors->first('sex_customer') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone_customer" placeholder="Số điện thoại" class="form-control">@if($errors->has('phone_customer'))
                                <p class="alert alert-danger">{{ $errors->first('phone_customer') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_customer" placeholder="Mật khẩu" class="form-control">@if($errors->has('password_customer'))
                                <p class="alert alert-danger">{{ $errors->first('password_customer') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_customer_confirm" placeholder="Nhập lại mật khẩu" class="form-control">@if($errors->has('password_customer_confirm'))
                                <p class="alert alert-danger">{{ $errors->first('password_customer_confirm') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" name="address_customer" placeholder="Địa chỉ" class="form-control">@if($errors->has('address_customer'))
                                <p class="alert alert-danger">{{ $errors->first('address_customer') }}</p>
                                @endif
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-9">Bạn đã có tài khoản?<a href="{{URL::to('/login-customer')}}"><strong style="color: #ee4d2d;"> Đăng nhập</strong></a></div>
                            </div>
                            <input type="submit" name="register_customer" class="btn btn-lg btn-success btn-block" value="Đăng ký">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection