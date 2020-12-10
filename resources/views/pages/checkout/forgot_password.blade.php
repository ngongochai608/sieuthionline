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
                    <h3 class="panel-title">Điền Email để lấy lại mật khẩu</h3>
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
                    ?>
                    <form action="{{URL::to('/recover-password-customer')}}" method="POST" accept-charset="UTF-8" role="form">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Nhập Email ..." name="email_account" type="text">
                                @if($errors->has('email_account'))
                                <p class="alert alert-danger">{{ $errors->first('email_account')}}</p>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-default btn-block">Gửi</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection