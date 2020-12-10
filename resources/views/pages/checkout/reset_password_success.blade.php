@extends('layout')
@section('content')
<style type="text/css">
    .success{
        margin-top: 35px;
        margin-bottom: 105px;
    }
    .success img{
        padding-left: 15px;
    }
    .success a{
        margin-left: 108px;
        margin-bottom: 32px;
    }
    .success p{
        font-size: 17px;
        text-align: center;
    }
</style>
<div class="container login-form">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 success">
            <div class="panel panel-default" >
                <img src="{{asset('public/frontend/images/success.png')}}" width="350" height="250">
                <p>Khôi phục mật khẩu tài khoản thành công</p>
                <a href="{{URL::to('/login-customer')}}" class="btn btn-primary">Đăng nhập ngay</a>
            </div>
        </div>
    </div>
</div>
@endsection