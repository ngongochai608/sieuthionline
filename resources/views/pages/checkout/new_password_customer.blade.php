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
                    <h3 class="panel-title">Đặt lại mật khẩu</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    $Error = Session::get('Error');
                    if ($message) {
                        echo '<p class="alert alert-success">'.$message.'</p>';
                        Session::put('message',null);
                    }
                    if ($Error) {
                        echo '<p class="alert alert-danger">'.$Error.'</p>';
                        Session::put('Error',null);
                    }

                    $token = $_GET['token'];
                    $email = $_GET['email'];
                    ?>
                    <form action="{{URL::to('/reset-new-password-customer')}}" method="POST" accept-charset="UTF-8" role="form">
                        {{ @csrf_field() }}
                        <fieldset>
                            <input type="hidden" name="email" value="{{$email}}">
                            <input type="hidden" name="token" value="{{$token}}">
                            <div class="form-group">
                                <input class="form-control" placeholder="Nhập mật khẩu mới" name="new_password_customer" type="password">
                                @if($errors->has('new_password_customer'))
                                <p class="alert alert-danger">{{ $errors->first('new_password_customer')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Xác nhận mật khẩu" name="new_password_confirm_customer" type="password">
                                @if($errors->has('new_password_confirm_customer'))
                                <p class="alert alert-danger">{{ $errors->first('new_password_confirm_customer')}}</p>
                                @endif
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