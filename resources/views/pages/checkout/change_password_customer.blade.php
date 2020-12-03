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
                    <h3 class="panel-title">Đổi mật khẩu tài khoản khách hàng</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<p class="alert alert-success">'.$message.'</p>';
                        Session::put('message',null);
                    }
                    $message_error = Session::get('message_error');
                    if ($message_error) {
                        echo '<p class="alert alert-danger">'.$message_error.'</p>';
                        Session::put('message_error',null);
                    }
                    ?>
                    <form action="{{URL::to('/change-password-cus')}}" method="POST" accept-charset="UTF-8" role="form">
                        {{ @csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                <input type="password" style="margin-top: 10px;" id="hf-password" name="password_old" placeholder="Nhập mật khẩu hiện tại" class="form-control">@if($errors->has('password_old'))
                                <p class="alert alert-danger">{{ $errors->first('password_old')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" id="hf-password" name="password_new" placeholder="Nhập mật khẩu mới" class="form-control">@if($errors->has('password_new'))
                                <p class="alert alert-danger">{{ $errors->first('password_new')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" id="hf-password" name="password_new_confirm" placeholder="Nhập lại mật khẩu mới" class="form-control">@if($errors->has('password_new_confirm'))
                                <p class="alert alert-danger">{{ $errors->first('password_new_confirm')}}</p>
                                @endif
                            </div>
                            <input type="submit" onclick="return confirm('Bạn có chắc là muốn thay đổi mật khẩu tài khoản không?')" class="btn btn-warning btn-block" value="Thay đổi mật khẩu">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection