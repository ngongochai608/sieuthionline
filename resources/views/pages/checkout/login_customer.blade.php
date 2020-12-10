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
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Đăng nhập tài khoản khách hàng</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $message_error = Session::get('message_error');
                    if ($message_error) {
                        echo '<p class="alert alert-danger">'.$message_error.'</p>';
                        Session::put('message_error',null);
                    }
                    ?>
                    <form action="{{URL::to('/login-cus')}}" method="POST" accept-charset="UTF-8" role="form">
                        {{ @csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email_customer" type="text">
                                @if($errors->has('email_customer'))
                                <p class="alert alert-danger">{{ $errors->first('email_customer')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Mật khẩu" name="password_customer" type="password">
                                @if($errors->has('password_customer'))
                                <p class="alert alert-danger">{{ $errors->first('password_customer')}}</p>
                                @endif
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-9">Bạn chưa có tài khoản?<a href="{{URL::to('/register-customer')}}"><strong style="color: #ee4d2d;"> Đăng ký</strong></a></div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-9"><a href="{{URL::to('/quen-mat-khau')}}"> Quên mật khẩu</a></div>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Đăng nhập">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection